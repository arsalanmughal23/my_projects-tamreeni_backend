<?php

namespace App\Repositories;

use App\Models\UserDetail;
use App\Repositories\BaseRepository;

/**
 * Class UserDetailRepository
 * @package App\Repositories
 * @version January 30, 2024, 1:30 pm UTC
*/

class UserDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'dob',
        'image',
        'email_verified_at',
        'is_social_login',
        'gender',
        'language',
        'current_weight_in_kg',
        'target_weight_in_kg',
        'height_in_m',
        'goal',
        'diet_type',
        'current_weight_unit',
        'target_weight_unit',
        'height_unit'
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
        return UserDetail::class;
    }
}
