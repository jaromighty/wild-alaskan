<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_it_should_create_a_recipe_with_a_name_description_ingredients_steps_author_and_unique_slug(): void
    {
        $recipe = Recipe::factory()->create();
        Ingredient::factory(4)->create(['recipe_id' => $recipe->id]);
        Step::factory(5)->create(['recipe_id' => $recipe->id]);
        $queriedRecipe = Recipe::where('id', $recipe->id)->first();

        $this->assertDatabaseCount('recipes', 1);
        $this->assertNotEmpty($queriedRecipe->name);
        $this->assertNotEmpty($queriedRecipe->slug);
        $this->assertNotEmpty($queriedRecipe->description);
        $this->assertNotEmpty($queriedRecipe->author);
        $this->assertNotEmpty($queriedRecipe->ingredients);
        $this->assertNotEmpty($queriedRecipe->steps);
    }
}
