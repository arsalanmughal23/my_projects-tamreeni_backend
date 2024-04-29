<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $model = $this->model()::query();
        
        $orderableColumns = ['id','position'];

        if ($request->has('order')){
            $orderBy = $request->order_by;
            $orderBy == 'asc' ?: $orderBy = 'desc';
            $orderColumn = in_array($request->order, $orderableColumns) ? $request->order : $orderableColumns[0];

            $model = $model->orderBy($orderColumn, $orderBy);
        }
        return $model->get();
    }
}
