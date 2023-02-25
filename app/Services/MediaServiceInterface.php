<?php

namespace App\Services;

interface MediaServiceInterface
{
    public function getPage(string $mediaType, array $params): object;
    public function getTopRated(string $mediaType, $params): array;
    public function search(string $mediaType, array $params): object;
    public function detail(string $mediaType, array $ids, array $params): object;
    public function videos(string $mediaType, array $ids, array $params): object;
}
