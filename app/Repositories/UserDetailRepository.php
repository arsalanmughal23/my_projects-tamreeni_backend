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
        'is_social_login',
        'push_notification',
        'gender',
        'language',
        'current_weight_in_kg',
        'target_weight_in_kg',
        'height_in_m'
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

    public function updateRecord($data, $user)
    {
        $detail = $user->details;
        return $this->update($data, $detail->id);
    }
}
