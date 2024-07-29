<?php

namespace App\Repositories;

use App\Models\MembershipDuration;
use App\Models\PromoCode;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

/**
 * Class MembershipDurationRepository
 * @package App\Repositories
 * @version July 26, 2024, 10:45 am UTC
*/

class MembershipDurationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'membership_id',
        'title',
        'duration_in_month',
        'price'
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
        return MembershipDuration::class;
    }
    
    public function getRecords(Request $request)
    {
        $params = $request->only($this->getFieldsSearchable());
        $generalFilterParams = array_diff_key($params, array_flip(['title']));

        $query = $this->model->query();

        if ($title = $request->get('title')) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        $query->where($generalFilterParams);
        return $query;
    }
    
    public function getPriceByPromoCode(PromoCode $promoCode, MembershipDuration $membershipDuration)
    {
        $discountType = $promoCode['type'];
        $discountValue = $promoCode['value'];
        $discountPrice = $discountType == PromoCode::DISCOUNT_PERCENT 
            ? calcualteDiscountPrice($membershipDuration['price'], $discountType, $discountValue)
            : $promoCode['value'];

        $membershipDuration['discount_price'] = number_format($membershipDuration['price'] - $discountPrice, 2);
        $membershipDuration['promo_code'] = $promoCode;
        return $membershipDuration;
    }
}
