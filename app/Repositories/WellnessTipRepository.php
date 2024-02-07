<?php

namespace App\Repositories;

use App\Models\WellnessTip;
use App\Repositories\BaseRepository;

/**
 * Class WellnessTipRepository
 * @package App\Repositories
 * @version January 30, 2024, 1:30 pm UTC
*/

class WellnessTipRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'cover'
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
        return WellnessTip::class;
    }

    public function WellnessQuery()
    {
        return WellnessTip::query();
    }
}
