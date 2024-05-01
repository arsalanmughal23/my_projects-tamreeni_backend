<?php

namespace App\Repositories;

use App\Helper\FileHelper;
use App\Models\Option;
use App\Repositories\BaseRepository;

/**
 * Class OptionRepository
 * @package App\Repositories
 * @version April 26, 2024, 5:43 pm UTC
*/

class OptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question_id',
        'title',
        'image',
        'question_variable_name',
        'option_variable_name'
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
        return Option::class;
    }

    public function updateRecord($request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = FileHelper::s3Upload($data['image']);
        }

        return $this->update($data, $id);
    }
}
