<?php

namespace App\Repositories;

use App\Models\ExerciseBreakdown;
use App\Repositories\BaseRepository;

/**
 * Class ExerciseBreakdownRepository
 * @package App\Repositories
 * @version October 9, 2024, 8:39 am UTC
*/

class ExerciseBreakdownRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'goal',
        'how_long_time_to_workout',
        'exercise_category',
        'exercise_count',
        'sets',
        'reps',
        'time'
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
        return ExerciseBreakdown::class;
    }
}
