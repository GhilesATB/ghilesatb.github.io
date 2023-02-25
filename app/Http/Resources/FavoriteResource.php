<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'media_id' => $this->media_id,
            'popularity' => $this->popularity,
            'title' => $this->title,
            'overview' => $this->overview,
            'vote_average' => $this->vote_average,
            'poster_path' => $this->poster_path,
            'release_date' => $this->release_date,
        ];
    }
}
