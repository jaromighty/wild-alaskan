<?php

namespace Tests\Unit;

use App\Models\Recipe;
use Tests\TestCase;

class RecipeSearchTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $recipeOne = Recipe::factory()->create([
            'name' => 'Crispy Oven-Roasted Potatoes',
            'description' => 'Golden brown potatoes with a crispy exterior and fluffy inside — perfect as a side dish.',
            'author' => 'emma.sides@recipes.test',
        ]);
        $recipeOne->ingredients()->createMany([
            ['description' => '4 medium potatoes, diced'],
            ['description' => '2 tbsp olive oil'],
            ['description' => '1 tsp garlic powder'],
            ['description' => '1/2 tsp paprika'],
            ['description' => 'Salt and pepper to taste'],
        ]);
        $recipeOne->steps()->createMany([
            ['description' => 'Preheat oven to 425°F (220°C).'],
            ['description' => 'Toss diced potatoes with olive oil, garlic powder, paprika, salt, and pepper.'],
            ['description' => 'Spread the potatoes in a single layer on a baking sheet.'],
            ['description' => 'Roast for 25–30 minutes, flipping halfway, until the potatoes are crispy and golden.'],
        ]);

        $recipeTwo = Recipe::factory()->create([
            'name' => 'Cheesy Potato Scramble',
            'description' => 'A hearty breakfast scramble featuring eggs, cheese, and tender bits of potatoes.',
            'author' => 'kevin.breakfast@recipes.test',
        ]);
        $recipeTwo->ingredients()->createMany([
            ['description' => '2 eggs'],
            ['description' => '1/2 cup cooked potatoes, chopped'],
            ['description' => '1/4 cup shredded cheddar cheese'],
            ['description' => '1 tbsp butter'],
            ['description' => 'Salt and pepper to taste'],
        ]);
        $recipeOne->steps()->createMany([
            ['description' => 'In a skillet, melt butter over medium heat.'],
            ['description' => 'Add the chopped cooked potatoes and sauté for 2–3 minutes.'],
            ['description' => 'Whisk the eggs with salt and pepper, then pour into the skillet.'],
            ['description' => 'Stir gently until eggs are fully cooked.'],
            ['description' => 'Sprinkle cheese over the top and cook until melted.'],
            ['description' => 'Serve hot for a satisfying potato-filled breakfast.'],
        ]);
    }

    public function test_search_recipe_name_and_description_for_potato(): void
    {
        $response = $this->get(route('search', ['search' => 'potato']));
        $recipes = $response->json();
        $this->assertGreaterThan(0, count($recipes));
    }

    public function test_search_recipe_ingredients_and_steps_for_eggs(): void
    {
        $response = $this->get(route('search', ['search' => 'eggs']));
        $recipes = $response->json();
        $this->assertGreaterThan(0, count($recipes));
    }

    public function test_search_recipe_author(): void
    {
        $response = $this->get(route('search', ['author' => 'kevin.breakfast@recipes.test']));
        $recipes = $response->json();
        $this->assertGreaterThan(0, count($recipes));
    }
}
