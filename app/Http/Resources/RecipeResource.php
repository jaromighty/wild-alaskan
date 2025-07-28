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
        $ingredients = [];
        foreach ($this->ingredients as $ingredient) {
            $ingredients[] = $ingredient->description;
        }
        $steps = [];
        foreach ($this->steps as $step) {
            $steps[] = $step->description;
        }

        return [
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author,
            'ingredients' => $ingredients,
            'steps' => $steps,
        ];
    }
}
