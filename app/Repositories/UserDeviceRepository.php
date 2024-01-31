<?php

namespace App\Repositories;

use App\Models\UserDevice;
use App\Repositories\BaseRepository;

/**
 * Class UserDeviceRepository
 * @package App\Repositories
 * @version January 26, 2024, 11:25 pm UTC
*/

class UserDeviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'device_type',
        'device_token',
        'push_notification'
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
        return UserDevice::class;
    }

    public function updateOrCreate($search, $data)
    {
        return $this->model->updateOrCreate($search, $data);
    }
}
