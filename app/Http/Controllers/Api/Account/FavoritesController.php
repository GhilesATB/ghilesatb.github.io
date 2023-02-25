<?php

namespace App\Http\Controllers\Api\Account;
use App\Http\Controllers\Controller;
use App\Services\AccountService\AccountService;
use Illuminate\Http\Response;

class FavoritesController extends Controller
{
    public function index(AccountService $accountService)
    {
        $favorites = $accountService->getFavorites();

        return response()->json($favorites, Response::HTTP_OK);
    }

    public function store(string $media_id, AccountService $accountService)
    {
        $favorite = $accountService->getMedia(
                request()->input('media_type'),
                [request()->input('media_type') => $media_id],
                request()->query->all(),
            );

        return response()->json($favorite, Response::HTTP_OK);
    }

    public function destroy(string $favorite_id, AccountService $accountService)
    {
        $accountService->removeFavorite($favorite_id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
