<?php

namespace App\Repositories;

use App\Models\Meal;
use App\Repositories\BaseRepository;

/**
 * Class MealRepository
 * @package App\Repositories
 * @version January 30, 2024, 3:05 pm UTC
*/

class MealRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'diet_type',
        'meal_category_id',
        'name',
        'image',
        'calories',
        'description'
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
        return Meal::class;
    }

    public function getMeals($params = []){

        $query = Meal::query();

        if(isset($params['diet_type'])){
            $query->where('diet_type_slug', $params['diet_type']);
        }

        if(isset($params['meal_category_ids'])){
            $mealCategoryIds = array_map('intval', $params['meal_category_ids']);
            $query->whereIn('meal_category_id', $mealCategoryIds);
        }

        if(isset($params['is_favourite'])){
            $query->whereHas('favourites', function($q){
                return $q->where('user_id', auth()->id());
            });
        }

        if (isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
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
        
        if(isset($params['food_preferences'])){
            $foodPreferences = $params['food_preferences'];
            $query->whereHas('foodPreferences', function($q) use($foodPreferences) {
                return $q->whereIn('slug', $foodPreferences);
            });
        }
        
        if(isset($params['meal_type'])){
            $mealType = $params['meal_type'];
            $query->whereHas('mealType', function($mealTypeQuery) use($mealType) {
                return $mealTypeQuery->whereSlug($mealType);
            });
        }
        
        if(isset($params['meal_types'])){
            
            $mealTypes = $params['meal_types'];

            if(!is_array($mealTypes))
                $mealTypes = explode(',', $mealTypes);

            $query->whereHas('mealType', function($mealTypeQuery) use($mealTypes) {
                return $mealTypeQuery->whereIn('slug', $mealTypes);
            });
        }

        return $query;
    }
}
