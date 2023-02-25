<?php

namespace App\Services\DataSource;

use App\Enums\Terms;
use App\Exceptions\DataSourceException;
use App\Exceptions\InvalidArgumentException;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class MediaDataSource implements ExternalApiDataSourceInterface
{
    public function __construct(private readonly string $base_url)
    {
    }

    /*
     * build and request data from external Api based on term media_type , ids and request parameters
     */
    public function getData(string $term, string $mediaType, string $id = null, $params = null): object
    {
        $uri = $this->makeUri($term, $mediaType, $id);
        $data = $this->RequestData($uri, $params);

        return $data;
    }

    /*
     * request data from external api based on uri and request params using authorization token
     */
    public function RequestData(string $uri, array $params): object
    {
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . env('TMDB_API_TOKEN')])->get($uri, $params);
            $data = json_decode($response->body());

            return $data;
        } catch (Exception $e) {
            throw new DataSourceException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /*
     * build request uri based on term and ids
     */
    private function makeUri(string $term, string $mediaType, string $id = null): string
    {
        $uri = match ($term) {
            Terms::DISCOVER->value => "{$this->base_url}/discover/" . $mediaType,
            Terms::TOP_RATED->value => "{$this->base_url}/{$mediaType}/top_rated",
            Terms::SEARCH->value => "{$this->base_url}/search/{$mediaType}",
            Terms::DETAIL->value => "{$this->base_url}/{$mediaType}/{$id}",
            Terms::VIDEOS->value => "{$this->base_url}/{$mediaType}/{$id}/videos",

            default => throw new InvalidArgumentException('the given value is invalid', Response::HTTP_BAD_REQUEST)
        };

        return $uri;
    }
}
