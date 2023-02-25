<?php

namespace App\Services\MediaService;

/*
 * interfaces to be implemented for Media services
 */
interface MediaServiceInterface
{
    public function getPage(string $mediaType, array $params): object;
    public function getTopRated(string $mediaType, $params): array;
    public function search(string $mediaType, array $params): object;
    public function detail(string $mediaType, string $id, array $params): object;
    public function videos(string $mediaType, string $id, array $params): object;
}
