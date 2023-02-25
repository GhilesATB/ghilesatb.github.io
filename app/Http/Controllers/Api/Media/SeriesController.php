<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Services\MediaService;
use Illuminate\Http\Response;

class SeriesController extends Controller
{
    public function index(MediaService $mediaService)
    {
        $data = $mediaService->getPage('movie', request()->query->all());

        return response()->json($data, Response::HTTP_OK);
    }

    public function topRated(MediaService $service)
    {
        $slice = $service->getTopRated('movie', request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function search(MediaService $service)
    {
        $slice = $service->search('movie', request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function detail(string $id, MediaService $service)
    {
        $slice = $service->detail('movie', ['movie' => $id], request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function videos(string $id, MediaService $service)
    {
        $slice = $service->videos('movie', ['movie' => $id], request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }
}
