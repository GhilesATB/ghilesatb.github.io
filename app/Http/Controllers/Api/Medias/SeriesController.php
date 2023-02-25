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
        $slice = $service->detail(self::MEDIA, [self::MEDIA => $id], request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function videos(string $id, MediaService $service): JsonResponse
    {
        $slice = $service->videos(self::MEDIA, [self::MEDIA => $id], request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }
}
