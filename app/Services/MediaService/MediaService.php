<?php

namespace App\Services\MediaService;

use App\Services\DataSource\ExternalApiDataSourceInterface;

class MediaService implements MediaServiceInterface
{
    public function __construct(private ExternalApiDataSourceInterface $dataSource)
    {
    }

    /*
     * get list of media
     */
    public function getPage(string $mediaType, array $params): object
    {
        return $this->dataSource->getData('discover', $mediaType, null, $params);
    }

    /*
     * get top-rated 5 media
     */
    public function getTopRated(string $mediaType, $params): array
    {
        $per_page = 5;

        $data = $this->dataSource->getData('top_rated', $mediaType, null, $params);

        $items = array_slice($data->results, 0, $per_page);

        return $items;
    }

    /*
     * search media
     */
    public function search(string $mediaType, array $params): object
    {
        return $this->dataSource->getData('search', $mediaType, null, $params);
    }

    /*
     * get media detail
     */
    public function detail(string $mediaType, array $ids, array $params): object
    {
        return $this->dataSource->getData('detail', $mediaType, $ids, $params);
    }

    /*
     * get media videos
     */
    public function videos(string $mediaType, array $ids, array $params): object
    {
        return $this->dataSource->getData('top_rated', $mediaType, $ids, $params);
    }
}

