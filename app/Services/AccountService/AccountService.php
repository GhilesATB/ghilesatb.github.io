<?php

namespace App\Services\AccountService;

use App\Exceptions\UnAuthenticatedUserException;
use App\Models\Favorite;
use App\Services\MediaService\MediaServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Exception;

class AccountService implements AccountServiceInterface
{
    public function __construct(private MediaServiceInterface $mediaService)
    {
    }

    /*
     * media data
     */
    public function getMedia(string $mediaType, string $id, $params): Favorite
    {
        $favorite = Favorite::where('media_id', request()->input('media_id'))->first();

        if (blank($favorite)) {
            $data = $this->mediaService->detail(
                $mediaType,
                $id,
                $params
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
        try {
            $favorites = Auth::user()->favorites;

            return $favorites;
        } catch(Exception $exception) {
            throw new UnAuthenticatedUserException($exception->getCode(), $exception->getMessage(), $exception);
        }
    }

    public function removeFavorite(string $favorite_id): void
    {
        try {
            $favorite = Auth::user()->favorites()->where('id', $favorite_id)->firstOrFail();

            $favorite->delete();
        } catch(Exception $exception) {
            throw new UnAuthenticatedUserException($exception->getCode(), $exception->getMessage(), $exception);
        }
    }
}