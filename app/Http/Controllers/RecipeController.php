<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function show(Request $request, Recipe $recipe): RecipeResource
    {
        return new RecipeResource($recipe);
    }
}
