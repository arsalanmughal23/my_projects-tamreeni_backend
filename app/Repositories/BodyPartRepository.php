<?php

namespace App\Repositories;

use App\Models\BodyPart;
use App\Repositories\BaseRepository;

/**
 * Class BodyPartRepository
 * @package App\Repositories
 * @version February 5, 2024, 12:05 pm UTC
*/

class BodyPartRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image'
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
        return BodyPart::class;
    }
}
