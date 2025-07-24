<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = [
            [
                'name' => 'Peanut Butter Banana Toast',
                'description' => 'A quick and healthy breakfast made with creamy peanut butter and fresh bananas.',
                'author' => 'sarah.simple@recipes.test',
                'ingredients' => [
                    '1 slice whole grain bread',
                    '2 tbsp peanut butter',
                    '1 banana, sliced'
                ],
                'steps' => [
                    'Toast the slice of bread to your desired crispness.',
                    'Spread peanut butter evenly over the toast.',
                    'Top with sliced banana.',
                    'Serve immediately.'
                ]
            ],
            [
                'name' => 'Microwave Scrambled Eggs',
                'description' => 'A fast and protein-packed breakfast you can make in under 5 minutes.',
                'author' => 'mike.quick@recipes.test',
                'ingredients' => [
                    '2 eggs',
                    '2 tbsp milk',
                    'Salt and pepper to taste',
                    'Cooking spray or butter'
                ],
                'steps' => [
                    'Spray a microwave-safe mug or bowl with cooking spray or grease with butter.',
                    'Crack the eggs into the mug, add milk, and whisk with a fork.',
                    'Microwave on high for 30 seconds, stir, then microwave for another 30-45 seconds until set.',
                    'Season with salt and pepper and serve.'
                ]
            ],
            [
                'name' => 'Tuna Salad Sandwich',
                'description' => 'A simple tuna salad served between slices of bread for a quick lunch.',
                'author' => 'laura.lunch@recipes.test',
                'ingredients' => [
                    '1 can tuna, drained',
                    '2 tbsp mayonnaise',
                    '1 tbsp diced celery (optional)',
                    'Salt and pepper to taste',
                    '2 slices sandwich bread'
                ],
                'steps' => [
                    'In a bowl, combine tuna, mayonnaise, celery (if using), salt, and pepper.',
                    'Mix until well combined.',
                    'Spread mixture between two slices of bread.',
                    'Cut in half and serve.'
                ]
            ],
            [
                'name' => 'Garlic Butter Pasta',
                'description' => 'A no-fuss pasta dish flavored with garlic and butter.',
                'author' => 'tony.simple@recipes.test',
                'ingredients' => [
                    '2 cups cooked pasta',
                    '2 tbsp butter',
                    '2 cloves garlic, minced',
                    'Salt and parmesan to taste'
                ],
                'steps' => [
                    'In a skillet, melt butter over medium heat.',
                    'Add minced garlic and sauté for 1-2 minutes.',
                    'Add the cooked pasta and toss to coat.',
                    'Season with salt and sprinkle with parmesan before serving.'
                ]
            ],
            [
                'name' => 'No-Bake Chocolate Oat Cookies',
                'description' => 'Quick no-bake cookies that are perfect for a sweet snack.',
                'author' => 'jenny.snacks@recipes.test',
                'ingredients' => [
                    '1/2 cup milk',
                    '1/4 cup butter',
                    '1/4 cup cocoa powder',
                    '1 cup sugar',
                    '1/2 cup peanut butter',
                    '1 tsp vanilla extract',
                    '1 1/2 cups quick oats'
                ],
                'steps' => [
                    'In a saucepan, combine milk, butter, cocoa, and sugar.',
                    'Bring to a boil and cook for 1 minute.',
                    'Remove from heat and stir in peanut butter and vanilla until smooth.',
                    'Mix in oats and drop by spoonfuls onto wax paper.',
                    'Let cool until set.'
                ]
            ]
        ];

        foreach ($recipes as $recipe) {
            $recipeModel = Recipe::create([
                'name' => $recipe['name'],
                'author' => $recipe['author'],
                'description' => $recipe['description'],
            ]);
            foreach ($recipe['ingredients'] as $ingredient) {
                $recipeModel->ingredients()->create([
                    'description' => $ingredient,
                ]);
            }
            foreach ($recipe['steps'] as $step) {
                $recipeModel->steps()->create([
                    'description' => $step,
                ]);
            }
        }
    }
}
