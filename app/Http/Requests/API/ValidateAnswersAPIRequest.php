<?php

namespace App\Http\Requests\API;

use App\Models\Constant;
use App\Models\Question;

class ValidateAnswersAPIRequest extends BaseAPIRequest
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
            'goal'   => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q1_GOAL,
            'gender' => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q2_GENDER,
            'dob'    => 'sometimes|date|date_format:"d-m-Y"|before:today',

            'height'                => 'sometimes|numeric|'.$this->getConditionalHeightRule('height'),
            'height_unit'           => 'sometimes|string|exists:constants,key,group,' . Constant::CONST_SIZE_UNIT,
            'current_weight'        => 'sometimes|numeric|'.$this->getConditionalWeightRule('current_weight'),
            'current_weight_unit'   => 'sometimes|string|exists:constants,key,group,' . Constant::CONST_WEIGHT_UNIT,
            'target_weight_unit'    => 'sometimes|string|same:current_weight_unit',
            // 'target_weight_unit'    => 'sometimes|string|exists:constants,key,group,' . Constant::CONST_WEIGHT_UNIT,
            'target_weight'         => 'sometimes|numeric|'.$this->getConditionalWeightRule('target_weight'),

            'workout_days_in_a_week'   => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q7_WORKOUT_DAYS_IN_A_WEEK,
            // 'workout_duration_per_day' => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q8_WORKOUT_DURATION_PER_DAY,
            'workout_prefered_place'   => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q9_WORKOUT_PREFERED_PLACE,
            'equipment_type'           => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q10_EQUIPMENT_TYPE,
            'have_a_scale'             => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q11_HAVE_A_SCALE,
            'how_long_time_to_workout' => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q12_HOW_LONG_TIME_TO_WORKOUT,
            'reach_goal_target_date'   => 'sometimes|date|date_format:"d-m-Y"|after:' . \Carbon\Carbon::yesterday()->addWeek(1)->format('d-m-Y') . '|before:' . \Carbon\Carbon::tomorrow()->addWeek(8)->format('d-m-Y'),
            'body_parts'               => 'sometimes|array',
            'body_parts.*'             => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q14_BODY_PARTS,
            'diet_type'                => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q15_DIET_TYPE,
            'food_preferences'         => 'sometimes|array',
            'food_preferences.*'       => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q16_FOOD_PREFERENCES,

            'level'             => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q17_LEVEL,
            // 'health_status'     => 'required_if:gender,female|string|exists:options,option_variable_name,question_variable_name,' . Question::Q18_HEALTH_STATUS,
            'health_status'     => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q18_HEALTH_STATUS,
            'daily_steps_taken' => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q19_DAILY_STEPS_TAKEN,

            'physically_active' => 'sometimes|string|exists:options,option_variable_name,question_variable_name,' . Question::Q20_PHYSICALLY_ACTIVE,

            // 'squat__one_rep_max_in_kg'      => 'required_if:level,intermediate,advanced|numeric|min:1|max:200',
            // 'deadlift__one_rep_max_in_kg'   => 'required_if:level,intermediate,advanced|numeric|min:1|max:200',
            // 'bench__one_rep_max_in_kg'      => 'required_if:level,intermediate,advanced|numeric|min:1|max:200',
            // 'overhead__one_rep_max_in_kg'   => 'required_if:level,intermediate,advanced|numeric|min:1|max:200',

            'squat__one_rep_max_in_kg'      => 'sometimes|numeric|min:1|max:200',
            'deadlift__one_rep_max_in_kg'   => 'sometimes|numeric|min:1|max:200',
            'bench__one_rep_max_in_kg'      => 'sometimes|numeric|min:1|max:200',
            'overhead__one_rep_max_in_kg'   => 'sometimes|numeric|min:1|max:200'
        ];
    }

    /**
     * Apply conditional validation rule for 'value' based on 'unit'
     *
     * @return \Illuminate\Validation\Rules\Rule
     */
    protected function getConditionalHeightRule($fieldName)
    {
        $rules = match ($this->input($fieldName.'_unit')){
            'cm' => 'min:40', // Minimum Height is 40 when unit is cm
            'ft' => 'min:1', // Minimum Height is 1 when unit is ft
            default => 'min:1' // Minimum Height is 1 when unit is ft
        };
        return $rules;
    }

    protected function getConditionalWeightRule($fieldName)
    {
        $rules = match ($this->input($fieldName.'_unit')){
            'kg' => 'min:1', // Minimum Height is 40 when unit is cm
            'lbs' => 'min:2.2', // Minimum Height is 1 when unit is ft
            default => 'min:1' // Minimum Height is 1 when unit is ft
        };

        // Check rule is used for target weight
        if($fieldName == 'target_weight'){
            // Set min / max rules according to selected goal
            $rules .= match ($this->input('goal')){
                'lose_weight' => '|max:'.$this->input('current_weight'),
                'gain_weight' => '|min:'.$this->input('current_weight'),
                default => '|min:1'
                // 'build_muscle' => '|min:'.$this->input('current_weight'),
                // 'get_fit' => '|min:'.$this->input('current_weight')
            };
        }

        return $rules;
    }
}
