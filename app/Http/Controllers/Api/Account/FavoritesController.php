<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Services\AccountService\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class FavoritesController extends Controller
{
    public function index(AccountService $accountService): JsonResponse
    {
        $favorites = $accountService->getFavorites();

        return response()->json($favorites, Response::HTTP_OK);
    }

    public function store(string $media_id, AccountService $accountService): JsonResource
    {
        $favorite = $accountService->getMedia(
            request()->input('media_type'),
            $media_id,
            request()->query->all(),
        );

        return FavoriteResource::make($favorite);
    }

    public function destroy(string $favorite_id, AccountService $accountService): JsonResponse
    {
        $accountService->removeFavorite($favorite_id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}