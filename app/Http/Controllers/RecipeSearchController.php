<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class RecipeSearchController extends Controller
{
    use RefreshDatabase;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RecipeResource
    {
        $search = $request->get('search');

        $recipe = Recipe::query()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhereHas('ingredients', function ($query) use ($search) {
                $query->where('description', 'like', '%' . $search . '%');
            })
            ->orWhereHas('steps', function ($query) use ($search) {
                $query->where('description', 'like', '%' . $search . '%');
            })
            ->get();

        return new RecipeResource($recipe);
    }
}
