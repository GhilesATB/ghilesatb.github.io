<?php

namespace App\Services\MediaService;

use App\Exceptions\MediaServiceException;
use App\Services\DataSource\ExternalApiDataSourceInterface;
use Exception;
use Illuminate\Support\Facades\Cache;

class MediaService implements MediaServiceInterface
{
    public function __construct(private ExternalApiDataSourceInterface $dataSource)
    {
    }

    /*
     * get list of media
     *
     * issue TMDB supports doesn't support dynamic per_page results(default 20)
     * link: https://www.themoviedb.org/talk/5980b70692514149290159b7
     */
    public function getPage(string $mediaType, array $params): object
    {
        try {
            $page = $params['page'] ?? 1;
            $per_page = 10;

            $offset = ($page % 2 === 1) ? 0 : $per_page;
            //page number to be used by TMDB api
            $tmdb_page = (int)floor($page / 2) + 1;
            $params['page'] = (int)floor($page / 2) + 1;

            //empty cache
            if (Cache::missing('paginated_data')) {
                $data = $this->dataSource->getData('discover', $mediaType, null, $params);
                Cache::put('paginated_data', ["page" => $data, 'tmdb_page' => $tmdb_page], 60);

                // page changed (page to request from TMDB)
            } elseif (filled($cached_page_num = Cache::get('paginated_data')['tmdb_page']) &&
                ($cached_page_num !== $tmdb_page)) {

                $data = $this->dataSource->getData('discover', $mediaType, null, $params);
                Cache::put('paginated_data', ["page" => $data, 'tmdb_page' => $tmdb_page], 60);

                //load data from cache
            } else {
                $data = Cache::get('paginated_data')['page'];
            }

            $data->page = $page;
            $data->total_pages = (int)ceil($data->total_results / $per_page);
            $data->results = array_slice($data->results, $offset, $per_page);

            return $data;
        } catch (Exception $exception) {
            throw new MediaServiceException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /*
     * get top-rated 5 media
     */
    public function getTopRated(string $mediaType, $params): array
    {
        try {
            $per_page = 5;

            $data = $this->dataSource->getData('top_rated', $mediaType, null, $params);

            $items = array_slice($data->results, 0, $per_page);

            return $items;
        } catch (Exception $exception) {
            throw new MediaServiceException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /*
     * search media
     */
    public function search(string $mediaType, array $params): object
    {
        try {
            return $this->dataSource->getData('search', $mediaType, null, $params);
        } catch (Exception $exception) {
            throw new MediaServiceException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /*
     * get media detail
     */
    public function detail(string $mediaType, string $id, array $params): object
    {
        try {
            return $this->dataSource->getData('detail', $mediaType, $id, $params);
        } catch (Exception $exception) {
            throw new MediaServiceException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /*
     * get media videos
     */
    public function videos(string $mediaType, string $id, array $params): object
    {
        try {
            return $this->dataSource->getData('videos', $mediaType, $id, $params);
        } catch (Exception $exception) {
            throw new MediaServiceException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
