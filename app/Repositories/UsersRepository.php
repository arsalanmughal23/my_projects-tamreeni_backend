<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class UsersRepository
 * @package App\Repositories
 * @version January 10, 2023, 8:51 am UTC
 */
class UsersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
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
        return User::class;
    }

    public function getUsers($params = [])
    {

        $query = User::query();

        // Exclude roles with IDs 1 and 2
        $excludedRoleIds = [1, 2];

        // Exclude roles with IDs 1 and 2 from all queries
        $query->whereDoesntHave('roles', function ($q) use ($excludedRoleIds) {
            $q->whereIn('id', $excludedRoleIds);
        });

        if (isset($params['role'])) {
            $role = $params['role'];
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('id', $role);
            });
        }

        if (isset($params['search'])) {
            $search = $params['search'];
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%');
            });
        }

        if(isset($params['order']) && isset($params['order_by'])){
            $query->orderBy($params['order'], $params['order_by']);
        }

        return $query;
    }
}
