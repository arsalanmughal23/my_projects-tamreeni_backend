<?php

namespace App\Repositories;

use App\Models\WorkoutDayExercise;
use App\Repositories\BaseRepository;

/**
 * Class WorkoutDayExerciseRepository
 * @package App\Repositories
 * @version April 1, 2024, 8:01 am UTC
*/

class WorkoutDayExerciseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'workout_day_id',
        'exercise_id',
        'duration',
        'sets',
        'reps',
        'burn_calories',
        'status'
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
        return WorkoutDayExercise::class;
    }
}
