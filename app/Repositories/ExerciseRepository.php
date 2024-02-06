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
        return Exercise::where('id', $id)->with( 'bodyPart', 'exerciseEquipmentPivots.exerciseEquipment')->first();
    }
}
