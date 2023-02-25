<?php

namespace App\Http\Controllers\Api\Medias;

use App\Http\Controllers\Controller;
use App\Services\MediaService\MediaService;
use Illuminate\Http\Response;

class SeriesController extends Controller
{
    public function index(MediaService $mediaService)
    {
        $data = $mediaService->getPage('tv', request()->query->all());

        return response()->json($data, Response::HTTP_OK);
    }

    public function topRated(MediaService $service)
    {
        $slice = $service->getTopRated('tv', request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function search(MediaService $service)
    {
        $slice = $service->search('tv', request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function detail(string $id, MediaService $service)
    {
        $slice = $service->detail('tv', ['tv' => $id], request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }

    public function videos(string $id, MediaService $service)
    {
        $slice = $service->videos('tv', ['tv' => $id], request()->query->all());

        return response()->json($slice, Response::HTTP_OK);
    }
}