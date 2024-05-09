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
        'height_in_cm'
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
        $userDetail = $user->details;

        if($data['dob'])
            $userDetail->age = \Carbon\Carbon::parse($data['dob'])->age;

        if($data['height'] && $data['height_unit'])
            $userDetail->height_in_cm = convertSizeToCM($data['height'], $data['height_unit']);

        if($data['current_weight'] && $data['current_weight_unit'])
            $userDetail->current_weight_in_kg = convertWeightToKG($data['current_weight'], $data['current_weight_unit']);

        if($data['target_weight'] && $data['target_weight_unit'])
            $userDetail->target_weight_in_kg = convertWeightToKG($data['target_weight'], $data['target_weight_unit']);

        if($userDetail->current_weight_in_kg && $userDetail->height_in_cm){
            $calculatedBMI = calculateBMI($userDetail->current_weight_in_kg, $userDetail->height_in_cm);
            $calculatedBMI = number_format($calculatedBMI, 2);
            $userDetail->bmi = $calculatedBMI;
        }

        $userDetail->save();
        return $this->update($data, $userDetail->id);
    }
}
