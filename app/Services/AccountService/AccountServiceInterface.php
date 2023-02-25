<?php

namespace App\Services\AccountService;

use App\Models\Favorite;
use Illuminate\Support\Collection;

/*
 * interfaces to be implemented for Account services
 */
interface AccountServiceInterface
{
    public function getMedia(string $mediaType, array $ids, $params): Favorite;

    public function getFavorites(): Collection;

    public function removeFavorite(string $favorite_id): void;
}
