<?php

namespace App\Repositories;

use App\Models\UsedPromoCode;
use App\Repositories\BaseRepository;

/**
 * Class UsedPromoCodeRepository
 * @package App\Repositories
 * @version July 25, 2024, 9:36 am UTC
*/

class UsedPromoCodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'morphable_type',
        'morphable_id',
        'code',
        'value',
        'type'
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
        return UsedPromoCode::class;
    }
}
