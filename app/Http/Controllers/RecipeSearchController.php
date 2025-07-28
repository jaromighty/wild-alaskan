<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RecipeSearchController extends Controller
{
    use RefreshDatabase;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $search = $request->get('search');

        $recipes = Recipe::query()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhereHas('ingredients', function ($query) use ($search) {
                $query->where('description', 'like', '%' . $search . '%');
            })
            ->orWhereHas('steps', function ($query) use ($search) {
                $query->where('description', 'like', '%' . $search . '%');
            })
            ->with(['ingredients', 'steps'])
            ->get();

        return RecipeResource::collection($recipes);
    }
}
