<?php

namespace App\Http\Requests\API;

use App\Models\Constant;
use App\Models\Question;

class SubmitAnswersAPIRequest extends BaseAPIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'goal'   => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q1_GOAL,
            'gender' => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q2_GENDER,
            'dob'    => 'required|date|date_format:"d-m-Y"|before:today',

            'height_in_m'          => 'required|numeric|min:0.1',
            'height_unit'          => 'required|string|exists:constants,key,group,' . Constant::CONST_SIZE_UNIT,
            'current_weight_in_kg' => 'required|numeric',
            'current_weight_unit'  => 'required|string|exists:constants,key,group,' . Constant::CONST_WEIGHT_UNIT,
            'target_weight_in_kg'  => 'required|numeric',
            'target_weight_unit'   => 'required|string|exists:constants,key,group,' . Constant::CONST_WEIGHT_UNIT,

            'workout_days_in_a_week'   => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q7_WORKOUT_DAYS_IN_A_WEEK,
            'workout_duration_per_day' => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q8_WORKOUT_DURATION_PER_DAY,
            'workout_prefered_place'   => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q9_WORKOUT_PREFERED_PLACE,
            'equipment_type'           => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q10_EQUIPMENT_TYPE,
            'have_a_scale'             => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q11_HAVE_A_SCALE,
            'how_long_time_to_workout' => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q12_HOW_LONG_TIME_TO_WORKOUT,
            'reach_goal_target_date'   => 'required|date|date_format:"d-m-Y"|after:' . \Carbon\Carbon::yesterday()->addWeek(1)->format('d-m-Y') . '|before:' . \Carbon\Carbon::tomorrow()->addWeek(3)->format('d-m-Y'),
            'body_parts'               => 'required|array',
            'body_parts.*'             => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q14_BODY_PARTS,
            'diet_type'                => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q15_DIET_TYPE,
            'food_preferences'         => 'required|array',
            'food_preferences.*'       => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q16_FOOD_PREFERENCES,

            'level'             => 'required|string|exists:options,option_variable_name,question_variable_name,' . Question::Q17_LEVEL,
            'health_status'     => 'string|exists:options,option_variable_name,question_variable_name,' . Question::Q18_HEALTH_STATUS,
            'daily_steps_taken' => 'string|exists:options,option_variable_name,question_variable_name,' . Question::Q19_DAILY_STEPS_TAKEN,
        ];
    }
}
