<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\BaseRepository;

/**
 * Class QuestionRepository
 * @package App\Repositories
 * @version April 26, 2024, 4:31 pm UTC
*/

class QuestionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'cover_image',
        'answer_mode',
        'question_variable_name',
        'question_secondary_variable_name'
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
        return Question::class;
    }
}
