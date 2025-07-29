<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $authors = Recipe::query()
            ->select('author')
            ->groupBy('author')
            ->orderBy('author')
            ->get();

        return AuthorResource::collection($authors);
    }
}
