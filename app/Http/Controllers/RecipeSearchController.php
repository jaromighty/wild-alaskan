<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class RecipeSearchController extends Controller
{
    use RefreshDatabase;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $search = $request->get('search');

        return Recipe::query()
            ->where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();
    }
}
