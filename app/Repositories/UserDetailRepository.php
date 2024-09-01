<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserDetail;
use App\Repositories\BaseRepository;

/**
 * Class UserDetailRepository
 * @package App\Repositories
 * @version January 30, 2024, 1:30 pm UTC
*/

class UserDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'dob',
        'image',
        'is_social_login',
        'push_notification',
        'gender',
        'language',
        'current_weight_in_kg',
        'target_weight_in_kg',
        'height_in_cm'
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
        return UserDetail::class;
    }

    public function updateRecord($data, User $user)
    {
        $userDetail = $user->details;

        if(isset($data['height']) && isset($data['height_unit']))
            $userDetail->height_in_cm = convertSizeToCM($data['height'], $data['height_unit']);

        if(isset($data['current_weight']) && isset($data['current_weight_unit']))
            $userDetail->current_weight_in_kg = convertWeightToKG($data['current_weight'], $data['current_weight_unit']);

        if(isset($data['target_weight']) && isset($data['target_weight_unit']))
            $userDetail->target_weight_in_kg = convertWeightToKG($data['target_weight'], $data['target_weight_unit']);

        if($userDetail?->current_weight_in_kg && $userDetail?->height_in_cm){
            $calculatedBMI = calculateBMI($userDetail->current_weight_in_kg, $userDetail->height_in_cm);
            $calculatedBMI = number_format($calculatedBMI, 2);
            $userDetail->bmi = $calculatedBMI;
        }

        if(isset($data['algo_required_calories']))
            $userDetail->algo_required_calories = $data['algo_required_calories'];

        if(isset($data['planed_answer_attempt_id']))
            $userDetail->planed_answer_attempt_id = $data['planed_answer_attempt_id'];

        if($userDetail) {
            $userDetail->save();
            $userDetail = $this->update($data, $userDetail->id);
        }
        return $userDetail;
    }

    public function clearQuestionnaireUserDetails(UserDetail $userDetails)
    {
        $data = [
            'language' => null,     'goal' => null,         'gender' => null,           'dob' => null,
            'height' => null,       'height_unit' => null,  'current_weight' => null,   'current_weight_unit' => null,
            'target_weight' => null,'target_weight_unit' => null,

            'workout_days_in_a_week' => null,'how_long_time_to_workout' => null,
            'equipment_type' => null,        'reach_goal_target_date' => null,

            'body_parts' => [], 'physically_active' => null, 'level' => null,

            'squat__one_rep_max_in_kg' => null, 'deadlift__one_rep_max_in_kg' => null,
            'bench__one_rep_max_in_kg' => null, 'overhead__one_rep_max_in_kg' => null,

            'health_status' => null,'daily_steps_taken' => null,
            'diet_type' => null,    'food_preferences' => [],
            'calories' => 0,

            'workout_duration_per_day' => null, 'age' => null,
            'height_in_cm' => null, 'current_weight_in_kg' => null, 'target_weight_in_kg' => null,
        ];

        $userDetails->update($data);

        $userDetails->age = null;
        $userDetails->height_in_cm = null;
        $userDetails->target_weight_in_kg = null;
        $userDetails->current_weight_in_kg = null;
        $userDetails->workout_duration_per_day = null;
        $userDetails->is_last_attempt_plan_generated = false;
        $userDetails->save();
        return $userDetails->refresh();
    }

    public function updatedStatusPlanIsGenerated(UserDetail $userDetails)
    {
        $userDetails->is_last_attempt_plan_generated = true;
        $userDetails->planed_answer_attempt_id = $userDetails->unplaned_answer_attempt_id;
        $userDetails->save();
        return $userDetails->refresh();
    }

    public function getPersonalStatistics(UserDetail $userDetails)
    {
        $calculatedBMI = $userDetails->bmi;
        $weightCategory = $this->getWeightCategory($calculatedBMI);

        return [
            'bmi'       => $calculatedBMI,
            'bmi_description' => __('messages.bmi_description', ['bmi' => $calculatedBMI, 'weight_category' => $weightCategory]),
            // 'user_details'      => $userDetails,
            'current_day_required_calories' => $userDetails?->algo_required_calories ?? 0,
            'workout_week_count' => now()->setTime(0,0)->diffInWeeks($userDetails->reach_goal_target_date) ?? 0,
            'current_week_target_calroies' => ($userDetails?->algo_required_calories ?? 0) * 7,
            'current_week_consumed_calroies' => $userDetails->calories,
            'weight_category' => $weightCategory
        ];
    }

    public function getWeightCategory($bmi = 0)
    {
        $weightCategory = 'normal';

        if ($bmi < 18.5)
            $weightCategory = 'underweight';
        else if ($bmi >= 18.5 && $bmi < 25)
            $weightCategory = 'normal';
        else if ($bmi >= 25 && $bmi < 30)
            $weightCategory = 'overweight';
        else if ($bmi >= 30 && $bmi < 40)
            $weightCategory = 'severe_obesity';
        else if ($bmi >= 40 && $bmi < 45)
            $weightCategory = 'morbid_obesity';
        else if ($bmi >= 45)
            $weightCategory = 'super_obesity';
        else
            $weightCategory = 'normal';

        return $weightCategory;
    }
}
