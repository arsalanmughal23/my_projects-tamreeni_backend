<?php

namespace App\Repositories;

use App\Models\UserSubscription;
use App\Repositories\BaseRepository;

/**
 * Class UserSubscriptionRepository
 * @package App\Repositories
 * @version March 22, 2024, 4:35 pm UTC
*/

class UserSubscriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'package_id',
        'transaction_id',
        'sessions',
        'remaining_sessions',
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
        return UserSubscription::class;
    }

    public function checkUserCurrentPackage($user_id, $package_id){
       return UserSubscription::where('user_id',$user_id)
           ->where('package_id', $package_id)
           ->where('status',UserSubscription::ACTIVE)
           ->first();
    }

    public function getCurrentPackage($user_id){
        return UserSubscription::where('user_id',$user_id)
            ->where('status',UserSubscription::ACTIVE)
            ->first();
    }
}
