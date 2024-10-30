<?php

namespace App\Repositories;

use App\Models\Recipe;
use App\Repositories\BaseRepository;

/**
 * Class RecipeRepository
 * @package App\Repositories
 * @version July 17, 2024, 4:13 am UTC
*/

class RecipeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'diet_type',
        'title',
        'description',
        'image',
        'instruction',
        'units_in_recipe',
        'divide_recipe_by',
        'number_of_units',
        'calories',
        'carbs',
        'fats',
        'protein'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Recipe::class;
    }

    public function getRecipeSelectOptions()
    {
        return $this->model()::pluck('title', 'id');
    }

    // Filters Implemented: 'units_in_recipe', 'diet_type', 'meal_category_ids', 'meal_category_slugs', 'keyword', 'min_calories', 'max_calories', 'calories', 'meal_type', 'title',
    // Filters UnAvailable: 'divide_recipe_by', 'number_of_units', 'carbs','fats','protein'
    public function getRecipes($params = [])
    {
        $userId = auth()->id();
        $query = Recipe::query()->with('recipeIngredients');

        if(isset($params['is_favourite'])){
            if($params['is_favourite'] == 'false'){
                $query->whereDoesntHave('favourites', function($q) use($userId) {
                    return $q->where('user_id', $userId);
                });
            } else {
                $query->whereHas('favourites', function($q) use($userId) {
                    return $q->where('user_id', $userId);
                });
            }
        }

        if(isset($params['diet_type'])){
            $query->where('diet_type', $params['diet_type']);
        }

        if(isset($params['meal_category_ids'])){
            $mealCategoryIds = array_map('intval', $params['meal_category_ids']);

            // $query->whereIn('meal_category_ids', $mealCategoryIds);
            $query->whereHas('mealCategories', function ($mealCategory) use ($mealCategoryIds) {
                return $mealCategory->whereIn('id', $mealCategoryIds);
            });
        }

        if(isset($params['meal_category_slugs'])){
            $mealCategorySlugs = $params['meal_category_slugs'];
            $query->whereHas('mealCategories', function ($mealCategory) use ($mealCategorySlugs) {
                return $mealCategory->whereIn('slug', $mealCategorySlugs);
            });
        }

        if(isset($params['title'])){
            $query->where('title', 'like', '%' . $params['title'] . '%');
        }

        if (isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('instruction', 'like', '%' . $keyword . '%');
            });
        }

        if(isset($params['min_calories'])){
            $minCalorie = floatval($params['min_calories']);
            $query->where('calories', '>=', $minCalorie);
        }

        if(isset($params['max_calories'])){
            $maxCalorie = floatval($params['max_calories']);
            $query->where('calories', '<=', $maxCalorie);
        }

        if(isset($params['calories'])){
            $query->where('calories', $params['calories']);
        }

        if(isset($params['units_in_recipe'])){
            $query->where('units_in_recipe', $params['units_in_recipe']);
        }

        if(isset($params['meal_type'])){
            $mealType = $params['meal_type'];
            $query->whereHas('mealType', function($mealTypeQuery) use($mealType) {
                return $mealTypeQuery->whereSlug($mealType);
            });
        }

        if (isset($params['order']) && isset($params['order_by'])) {
            $query->orderBy($params['order'], $params['order_by']);
        }

        return $query;
    }
}
