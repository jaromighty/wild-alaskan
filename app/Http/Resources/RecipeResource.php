<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author,
            'slug' => $this->slug,
            'ingredients' => $this->whenLoaded('ingredients', $this->ingredients),
            'steps' => $this->whenLoaded('steps', $this->steps),
        ];
    }
}
