<?php

namespace App\Services\DataSource;

use App\Exceptions\DataSourceException;
use Exception;
use Illuminate\Support\Facades\Http;

class MediaDataSource implements ExternalApiDataSourceInterface
{
    public function __construct(private readonly string $base_url)
    {
    }

    /*
     * request data from external api based on uri and request params using authorization token
     */
    public function RequestData(string $uri, array $params): object
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('TMDB_API_TOKEN')
            ])->get("{$this->base_url}/{$uri}", $params);

            $data = json_decode($response->body());

            return $data;
        } catch (Exception $e) {
            throw new DataSourceException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
