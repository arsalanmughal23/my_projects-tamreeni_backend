<?php

namespace App\Repositories;

use App\Models\Membership;
use App\Repositories\BaseRepository;

/**
 * Class MembershipRepository
 * @package App\Repositories
 * @version July 26, 2024, 8:24 am UTC
*/

class MembershipRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'feature_list',
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
        return Membership::class;
    }
}
