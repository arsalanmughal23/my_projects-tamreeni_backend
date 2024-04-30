<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Question
 * @package App\Models
 * @version April 26, 2024, 4:31 pm UTC
 *
 * @property string $title
 * @property string $cover_image
 * @property string $answer_mode
 * @property string $question_variable_name
 * @property string $question_secondary_variable_name
 */
class Question extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;

    public $table = 'questions';
    public $translatable = ['title'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'title',
        'cover_image',
        'answer_mode',
        'question_variable_name',
        'question_secondary_variable_name',
        'position'
    ];

    protected $with = ['options'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                               => 'integer',
        'title'                            => 'string',
        'cover_image'                      => 'string',
        'answer_mode'                      => 'string',
        'question_variable_name'           => 'string',
        'question_secondary_variable_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title'                            => 'required|array',
        'title.en'                         => 'required|string|max:1000',
        'title.ar'                         => 'required|string|max:1000',
        'cover_image'                      => 'nullable|string',
        'answer_mode'                      => 'required|string|max:191',
        'question_variable_name'           => 'required|string|max:191',
        'question_secondary_variable_name' => 'nullable|string|max:191',
        'created_at'                       => 'nullable',
        'updated_at'                       => 'nullable'
    ];

    const Q1_GOAL   = 'goal';
    const Q2_GENDER = 'gender';
    const Q3_DOB    = 'dob';

    const Q4_HEIGHT_IN_M          = 'height_in_m';
    const Q4_SEC                  = 'height_unit';
    const Q5_CURRENT_WEIGHT_IN_KG = 'current_weight_in_kg';
    const Q5_SEC                  = 'current_weight_unit';
    const Q6_TARGET_WEIGHT_IN_KG  = 'target_weight';
    const Q6_SEC                  = 'target_weight_unit';

    const Q7_WORKOUT_DAYS_IN_A_WEEK    = 'workout_days_in_a_week';
    const Q8_WORKOUT_DURATION_PER_DAY  = 'workout_duration_per_day';
    const Q9_WORKOUT_PREFERED_PLACE    = 'workout_prefered_place';
    const Q10_EQUIPMENT_TYPE           = 'equipment_type';
    const Q11_HAVE_A_SCALE             = 'have_a_scale';
    const Q12_HOW_LONG_TIME_TO_WORKOUT = 'how_long_time_to_workout';
    const Q13_REACH_GOAL_TARGET_DATE   = 'reach_goal_target_date';
    const Q14_BODY_PARTS               = 'body_parts';
    const Q15_DIET_TYPE                = 'diet_type';
    const Q16_FOOD_PREFERENCES         = 'food_preferences';
    const Q17_LEVEL                    = 'level';
    const Q18_HEALTH_STATUS            = 'health_status';
    const Q19_DAILY_STEPS_TAKEN        = 'daily_steps_taken';

    const Q1_OPTS = [Option::Q1_OPT1__LOSE_WEIGHT, Option::Q1_OPT2__GAIN_WEIGHT, Option::Q1_OPT3__BUILD_MUSCLE, Option::Q1_OPT4__GET_FIT];
    const Q2_OPTS = [Option::Q2_OPT1__MALE, Option::Q2_OPT2__FEMALE];

    const Q4_SEC_OPTS = Constant::CONST_SIZE_OPTS;
    const Q5_SEC_OPTS = Constant::CONST_WEIGHT_OPTS;
    const Q6_SEC_OPTS = Constant::CONST_WEIGHT_OPTS;

    const Q7_OPTS  = [Option::Q7_OPT1__1_TO_2_DAYS_A_WEEK, Option::Q7_OPT2__2_TO_4_DAYS_A_WEEK, Option::Q7_OPT3__5_DAYS_A_WEEK];
    const Q8_OPTS  = [Option::Q8_OPT1__5_TO_10_MINS_A_DAY, Option::Q8_OPT2__10_TO_15_MINS_A_DAY, Option::Q8_OPT3__15_TO_20_MINS_A_DAY];
    const Q9_OPTS  = [Option::Q9_OPT1__HOME, Option::Q9_OPT2__GYM];
    const Q10_OPTS = [Option::Q10_OPT1__ALL_EQUIPMENTS, Option::Q10_OPT2__FREE_WEIGHT, Option::Q10_OPT3__MACHINES, Option::Q10_OPT4__NO_EQUIPMENT_AT_ALL];
    const Q11_OPTS = [Option::Q11_OPT1__YES, Option::Q11_OPT2__NO];
    const Q12_OPTS = [Option::Q12_OPT1__30_MINS, Option::Q12_OPT2__45_MINS, Option::Q12_OPT3__1_HOUR, Option::Q12_OPT4__MORE_THAN_1_HOUR];
    const Q14_OPTS = [Option::Q14_OPT1__BACK, Option::Q14_OPT2__ARMS, Option::Q14_OPT3__CHEST, Option::Q14_OPT4__ABS, Option::Q14_OPT5__LEGS];
    const Q15_OPTS = [Option::Q15_OPT1__TRADITIONAL, Option::Q15_OPT2__KETO];
    const Q16_OPTS = [Option::Q16_OPT1__EGG, Option::Q16_OPT2__FISH, Option::Q16_OPT3__SHRIMP, Option::Q16_OPT4__DAIRY, Option::Q16_OPT5__VEGIES, Option::Q16_OPT6__SEA_FOOD];
    const Q17_OPTS = [Option::Q17_OPT1__BEGINNER, Option::Q17_OPT2__INTERMEDIATE, Option::Q17_OPT3__ADVANCED];
    const Q18_OPTS = [Option::Q18_OPT1__YES, Option::Q18_OPT2__NO];
    const Q19_OPTS = [Option::Q19_OPT1__2000_4000_STEPS, Option::Q19_OPT2__5000_7000_STEPS, Option::Q19_OPT3__7000_10000, Option::Q19_OPT3__10000_PLUS];


    public function options()
    {
        return $this->hasMany(Option::class, 'question_id');
    }


}
