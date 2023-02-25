<?php

namespace App\Services\AccountService;

use App\Models\Favorite;
use App\Services\MediaService\MediaServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AccountService implements AccountServiceInterface
{
    public function __construct(private MediaServiceInterface $mediaService)
    {
    }

    /*
     * media data
     */
    public function getMedia(string $mediaType, array $ids, $params): Favorite
    {
        $favorite = Favorite::where('media_id', request()->input('media_id'))->first();

        if (blank($favorite)) {
            $data = $this->mediaService->detail(
                $mediaType, $ids, $params
            );

            $favoriteData = [
                'user_id' => Auth::id(),
                'media_id' => $data->id,
                'popularity' => $data->popularity,
                'title' => $data->title,
                'overview' => $data->overview,
                'vote_average' => $data->vote_average,
                'poster_path' => $data->poster_path,
                'release_date' => $data->release_date,
            ];

            $favorite = Favorite::create($favoriteData);
        }
        return $favorite;
    }

    /*
     * retrieve authenticated user's favorites
     * */
    public function getFavorites(): Collection
    {
        $favorites = Auth::user()->favorites;

        return $favorites;
    }

    public function removeFavorite(string $favorite_id): void
    {
        $favorite = Auth::user()->favorites()->where('id', $favorite_id)->firstOrFail();

        $favorite->delete();
    }
}

