<?php

namespace App\Http\Controllers\Api\Medias;

use App\Http\Controllers\Controller;
use App\Services\MediaService\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MoviesController extends Controller
{
    const MEDIA = 'movie';

    public function index(MediaService $movieService): JsonResponse
    {
        $data = $movieService->getPage(self::MEDIA, request()->query->all());

        return response()->json($data, Response::HTTP_OK);
    }

    public function topRated(MediaService $service): JsonResponse
    {
        $slice = $service->getTopRated(self::MEDIA, request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function search(MediaService $service): JsonResponse
    {
        $slice = $service->search(self::MEDIA, request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function detail(string $id, MediaService $service): JsonResponse
    {
        $slice = $service->detail(self::MEDIA, $id, request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function videos(string $id, MediaService $service): JsonResponse
    {
        $slice = $service->videos(self::MEDIA, $id, request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }
}
