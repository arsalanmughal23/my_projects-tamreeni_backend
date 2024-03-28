<?php

namespace App\Repositories;

use App\Models\Exercise;
use App\Repositories\BaseRepository;

/**
 * Class ExerciseRepository
 * @package App\Repositories
 * @version February 6, 2024, 9:30 am UTC
 */
class ExerciseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'body_part_id',
        'name',
        'duration_in_m',
        'sets',
        'reps',
        'burn_calories',
        'image',
        'video',
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
        return Exercise::class;
    }

    public function exerciseDetails($id)
    {
        return Exercise::where('id', $id)->with('bodyPart', 'equipment')->first();
    }

    public function getExercises($params = [])
    {
        $query = Exercise::query()->with('bodyPart', 'equipment');

        if (isset($params['keyword'])) {
            $keyword = $params['keyword'];
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }
        if (isset($params['body_part_ids'])) {
            $bodyPartIds = explode(',', $params['body_part_ids']);
            $query->whereIn('body_part_id', $bodyPartIds);
        }

        if (isset($params['is_favourite'])) {
            $query->whereHas('favourites', function ($q) {
                return $q->where('user_id', auth()->id());
            });
        }

        if (isset($params['exercise_equipment_ids'])) {
            $exerciseEquipmentIds = explode(',', $params['exercise_equipment_ids']);
            $query->whereHas('equipment', function ($q) use ($exerciseEquipmentIds) {
                $q->whereIn('exercise_equipment_id', $exerciseEquipmentIds);
            });
        }

        if (isset($params['order']) && isset($params['order_by'])) {
            $query->orderBy($params['order'], $params['order_by']);
        }

        return $query;
    }
}
