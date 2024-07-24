<?php

namespace App\Repositories;

use App\Models\PromoCode;
use App\Repositories\BaseRepository;

/**
 * Class PromoCodeRepository
 * @package App\Repositories
 * @version July 24, 2024, 5:01 pm UTC
*/

class PromoCodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'value',
        'type',
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
        return PromoCode::class;
    }
}
