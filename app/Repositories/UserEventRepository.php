<?php

namespace App\Repositories;

use App\Models\UserEvent;
use App\Repositories\BaseRepository;

/**
 * Class UserEventRepository
 * @package App\Repositories
 * @version February 5, 2024, 12:36 pm UTC
*/

class UserEventRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'event_id'
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
        return UserEvent::class;
    }
}
