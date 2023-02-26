<?php

namespace App\Http\Controllers\Api\Medias;

use App\Http\Controllers\Controller;
use App\Services\MediaService\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SeriesController extends Controller
{
    const MEDIA = 'tv';

    public function index(MediaService $mediaService): JsonResponse
    {
        $data = $mediaService->getPage(self::MEDIA, request()->query->all());

        return response()->json($data, Response::HTTP_OK);
    }

    public function topRated(MediaService $mediaService): JsonResponse
    {
        $slice = $mediaService->getTopRated(self::MEDIA, request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function search(MediaService $mediaService): JsonResponse
    {
        $slice = $mediaService->search(self::MEDIA, request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function detail(string $id, MediaService $mediaService): JsonResponse
    {
        $slice = $mediaService->detail(self::MEDIA, $id, request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function videos(string $id, MediaService $mediaService): JsonResponse
    {
        $slice = $mediaService->videos(self::MEDIA, $id, request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }
}
