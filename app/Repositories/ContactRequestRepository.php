<?php

namespace App\Repositories;

use App\Models\ContactRequest;
use App\Repositories\BaseRepository;

/**
 * Class ContactRequestRepository
 * @package App\Repositories
 * @version March 6, 2024, 1:31 pm UTC
*/

class ContactRequestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'name',
        'email',
        'phone_number',
        'subject',
        'message'
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
        return ContactRequest::class;
    }
}
