<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\MealType;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeWithRelationalDataSeeder extends Seeder
{
    public function getMealCategoryIdsBySlugs(array $slugs)
    {
        return MealCategory::whereIn('slug', $slugs);
    }
    
    public function getMealTypeBySlug($slug)
    {
        return MealType::whereSlug($slug)->first();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Revert your changes, ensure to enable/disable foreign key checks accordingly
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Recipe::truncate();

        // Code to revert your migration changes
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // diet_type           => 'traditional', 'keto'
        // meal_category_slug  => 'veggies', 'shrimp', 'sea_food', 'fish', 'eggs', 'dairy'
        // meal_type           => 'breakfast', 'lunch', 'dinner', 'fruit', 'snack'
        $mealCategoryIds = $this->getMealCategoryIdsBySlugs(['veggies', 'shrimp', 'sea_food', 'fish', 'eggs', 'dairy'])->pluck('id');
        $biryaniIngredients = [
            ['en' => 'Chicken', 'ar' => 'فرخة'],
            ['en' => 'Rice', 'ar' => 'أرز'], 
        ];

        $recipes = [
            [
                'diet_type'         => Meal::DIET_TYPE_TRADITION_EN,
                'meal_category_ids' => $mealCategoryIds,
                'meal_type_id'      => $this->getMealTypeBySlug('breakfast')?->id,
                'title'             => ['en' => 'Biryani in breakfast', 'ar' => 'برياني'],
                'description'       => ['en' => 'Briyani is the delicious dish', 'ar' => 'برياني'],
                'instruction'       => ['en' => 'Boil the rice, make ready the qorma then mix each other', 'ar' => 'برياني'],
                'units_in_recipe'   => 20,
                'ingredients'       => $biryaniIngredients
            ],
            [
                'diet_type'         => Meal::DIET_TYPE_TRADITION_EN,
                'meal_category_ids' => $mealCategoryIds,
                'meal_type_id'      => $this->getMealTypeBySlug('lunch')?->id,
                'title'             => ['en' => 'Biryani in lunch', 'ar' => 'برياني'],
                'description'       => ['en' => 'Briyani is the delicious dish', 'ar' => 'برياني'],
                'instruction'       => ['en' => 'Boil the rice, make ready the qorma then mix each other', 'ar' => 'برياني'],
                'units_in_recipe'   => 20,
                'ingredients'       => $biryaniIngredients
            ],
            [
                'diet_type'         => Meal::DIET_TYPE_TRADITION_EN,
                'meal_category_ids' => $mealCategoryIds,
                'meal_type_id'      => $this->getMealTypeBySlug('dinner')?->id,
                'title'             => ['en' => 'Biryani in dinner', 'ar' => 'برياني'],
                'description'       => ['en' => 'Briyani is the delicious dish', 'ar' => 'برياني'],
                'instruction'       => ['en' => 'Boil the rice, make ready the qorma then mix each other', 'ar' => 'برياني'],
                'units_in_recipe'   => 20,
                'ingredients'       => $biryaniIngredients
            ],
            [
                'diet_type'         => Meal::DIET_TYPE_TRADITION_EN,
                'meal_category_ids' => $mealCategoryIds,
                'meal_type_id'      => $this->getMealTypeBySlug('fruit')?->id,
                'title'             => ['en' => 'Apple', 'ar' => 'تفاحة'],
                'description'       => ['en' => 'Apple 250 Gram', 'ar' => 'تفاحة'],
                'instruction'       => ['en' => '', 'ar' => ''],
                'units_in_recipe'   => 20
            ],
            [
                'diet_type'         => Meal::DIET_TYPE_TRADITION_EN,
                'meal_category_ids' => $mealCategoryIds,
                'meal_type_id'      => $this->getMealTypeBySlug('snack')?->id,
                'title'             => ['en' => 'Chips', 'ar' => 'رقائق'],
                'description'       => ['en' => 'Chips 150 Gram', 'ar' => 'رقائق'],
                'instruction'       => ['en' => '', 'ar' => ''],
                'units_in_recipe'   => 20
            ]
        ];

        foreach($recipes as $recipe)
        {
            $calorie = 1000;
            $stepper = 100;
            $maxCalorie = 3000;

            $recipeData = array_merge($recipe, [
                'divide_recipe_by'  => $recipe['divide_recipe_by'] ?? 1,
                'number_of_units'   => $recipe['number_of_units'] ?? 1,
                'carbs'             => $recipe['carbs'] ?? 100,
                'fats'              => $recipe['fats'] ?? 100,
                'protein'           => $recipe['protein'] ?? 100,
            ]);

            while ($calorie <= $maxCalorie) {

                $recipeIngredients = $recipeData['ingredients'] ?? [];
                unset($recipeData['ingredients']);

                $recipeData['diet_type'] = Meal::DIET_TYPE_TRADITION_EN;
                $recipeData['calories'] = $calorie;
                $traditionalRecipe = Recipe::create($recipeData);
                $traditionalRecipe->mealCategories()->sync($recipe['meal_category_ids']);
                
                $recipeData['diet_type'] = Meal::DIET_TYPE_KETO_EN;
                $ketoRecipe = Recipe::create($recipeData);
                $ketoRecipe->mealCategories()->sync($recipe['meal_category_ids']);

                if (count($recipeIngredients)) {
                    foreach ($recipeIngredients as $recipeIngredient) {
                        $traditionalRecipe->recipeIngredients()->create([
                            'type' => 'main',
                            'name' => $recipeIngredient,
                            'quantity' => 200,
                            'unit' => 'g',
                        ]);

                        $ketoRecipe->recipeIngredients()->create([
                            'type' => 'main',
                            'name' => $recipeIngredient,
                            'quantity' => 200,
                            'unit' => 'g',
                        ]);
                    }

                }

                $calorie += $stepper;
            }
        }
    }
}
