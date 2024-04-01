<?php

namespace App\Repositories;

use App\Models\UserSocialAccount;
use App\Repositories\BaseRepository;

/**
 * Class UserSocialAccountRepository
 * @package App\Repositories
 * @version January 27, 2024, 1:02 am UTC
 */
class UserSocialAccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'platform',
        'client_id',
        'token',
        'expires_at',
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
        return UserSocialAccount::class;
    }

}
