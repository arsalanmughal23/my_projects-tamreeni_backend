<?php

namespace Database\Seeders;

use App\Models\Constant;
use Illuminate\Database\Seeder;

class ConstantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Values for the 'language' group
        $this->seedGroup(Constant::CONST_LANGUAGE, Constant::CONST_LANG_OPTS);

        // Values for the 'size_unit' group
        $this->seedGroup(Constant::CONST_SIZE_UNIT, Constant::CONST_SIZE_OPTS);
        // Values for the 'weight_unit' group
        $this->seedGroup(Constant::CONST_WEIGHT_UNIT, Constant::CONST_WEIGHT_OPTS);
        
        // Values for the 'meal_type' group
        $this->seedGroup(Constant::CONST_MEAL_TYPE, Constant::CONST_MT_OPTS);

        // Values for the 'delete_account_type' group
        $this->seedGroup(Constant::CONST_GROUP_DELETE_ACCOUNT_TYPE, [
            'privacy_concerns',
            'inactivity',
            'dissatisfaction_with_the_platform_or_service',
            'lack_of_interest_in_the_platform_or_service',
            'moving_on_to_a_different_platform_or_service',
        ]);
    }
    
    private function seedGroup($group, $keys)
    {
        foreach ($keys as $key) {
            Constant::create([
                'group' => $group,
                'key' => $key,
            ]);
        }
    }
}
