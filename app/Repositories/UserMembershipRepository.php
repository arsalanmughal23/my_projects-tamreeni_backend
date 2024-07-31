<?php

namespace App\Repositories;

use App\Models\UserMembership;
use App\Repositories\BaseRepository;

/**
 * Class UserMembershipRepository
 * @package App\Repositories
 * @version July 29, 2024, 1:26 pm UTC
*/

class UserMembershipRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'user_id',
        'membership_id',
        'membership_duration_id',
        'duration_in_month',
        'expire_at',
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
        return UserMembership::class;
    }
}
