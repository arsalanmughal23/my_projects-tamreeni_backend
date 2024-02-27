<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    const Q1_OPT1__LOSE_WEIGHT = 'lose_weight';
    const Q1_OPT2__GAIN_WEIGHT = 'gain_weight';
    const Q1_OPT3__BUILD_MUSCLE = 'build_muscle';
    const Q1_OPT4__GET_FIT = 'get_fit';

    const Q2_OPT1__MALE = 'male';
    const Q2_OPT2__FEMALE = 'female';

    const Q7_OPT1__1_TO_2_DAYS_A_WEEK = '1_to_2_days_a_week';
    const Q7_OPT2__2_TO_4_DAYS_A_WEEK = '2_to_4_days_a_week';
    const Q7_OPT3__5_DAYS_A_WEEK = '5_days_a_week';
    
    const Q8_OPT1__5_TO_10_MINS_A_DAY = '5_to_10_mins_a_day';
    const Q8_OPT2__10_TO_15_MINS_A_DAY = '10_to_15_mins_a_day';
    const Q8_OPT3__15_TO_20_MINS_A_DAY = '15_to_20_mins_a_day';

    const Q9_OPT1__HOME = 'home';
    const Q9_OPT2__GYM = 'gym';

    const Q10_OPT1__ALL_EQUIPMENTS = 'all_equipments';
    const Q10_OPT2__FREE_WEIGHT = 'free_weight';
    const Q10_OPT3__MACHINES = 'machines';
    const Q10_OPT4__NO_EQUIPMENT_AT_ALL = 'no_equipment_at_all';

    const Q11_OPT1__YES = 'yes';
    const Q11_OPT2__NO = 'no';

    const Q12_OPT1__30_MINS = '30_mins';
    const Q12_OPT2__45_MINS = '45_mins';
    const Q12_OPT3__1_HOUR = '1_hour';
    const Q12_OPT4__MORE_THAN_1_HOUR = 'more_than_1_hour';

    const Q14_OPT1__BACK = 'back';
    const Q14_OPT2__ARMS = 'arms';
    const Q14_OPT3__CHEST = 'chest';
    const Q14_OPT4__ABS = 'abs';
    const Q14_OPT5__LEGS = 'legs';

    const Q15_OPT1__TRADITIONAL = 'traditional';
    const Q15_OPT2__KETO = 'keto';

    const Q16_OPT1__EGG = 'egg';
    const Q16_OPT2__FISH = 'fish';
    const Q16_OPT3__SHRIMP = 'shrimp';
    const Q16_OPT4__DAIRY = 'dairy';
    const Q16_OPT5__VEGIES = 'vegies';
    const Q16_OPT6__SEA_FOOD = 'sea_food';    

    const Q17_OPT1__BEGINNER = 'beginner';
    const Q17_OPT2__INTERMEDIATE = 'intermediate';
    const Q17_OPT3__ADVANCED = 'advanced';

    
    public function setOptionVariableNameAttribute($optionVariableName)
    {
        $this->attributes['option_variable_name'] = $optionVariableName;
        $name = ucwords(str_replace('_', ' ', $optionVariableName));
        $this->attributes['title'] = $name;

        return $this->attributes;
    }
}
