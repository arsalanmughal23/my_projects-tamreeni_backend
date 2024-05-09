<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

/**
 * Class Option
 * @package App\Models
 * @version April 26, 2024, 5:43 pm UTC
 *
 * @property integer $question_id
 * @property string $title
 * @property string $image
 * @property string $question_variable_name
 * @property string $option_variable_name
 */
class Option extends Model
{
    use HasFactory;
    use HasTranslations;

    public $table        = 'options';
    public $translatable = ['title'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'question_id',
        'title',
        'image',
        'question_variable_name',
        'option_variable_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                     => 'integer',
        'question_id'            => 'integer',
        'title'                  => 'string',
        'image'                  => 'string',
        'question_variable_name' => 'string',
        'option_variable_name'   => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'question_id'            => 'required',
        'title'                  => 'required|array',
        'title.en'               => 'required|string|max:70',
        'title.ar'               => 'required|string|max:70',
        'image'                  => 'nullable|file|mimes:jpeg,png|max:5000',
        'question_variable_name' => 'required|string|max:191',
        'option_variable_name'   => 'required|string|max:191',
    ];


    const OPTS_IMAGE = [
        self::Q2_OPT1__MALE         => 'https://tamreeni-backend.s3.amazonaws.com/male-3x.png',
        self::Q2_OPT2__FEMALE       => 'https://tamreeni-backend.s3.amazonaws.com/female.png',
        self::Q9_OPT1__HOME         => 'https://tamreeni-backend.s3.amazonaws.com/workoutHome-3x.png',
        self::Q9_OPT2__GYM          => 'https://tamreeni-backend.s3.amazonaws.com/workoutGym-3x.png',
        self::Q15_OPT1__TRADITIONAL => 'https://tamreeni-backend.s3.amazonaws.com/Traditional-3x.png',
        self::Q15_OPT2__KETO        => 'https://tamreeni-backend.s3.amazonaws.com/Keto-3x.png',

        self::Q16_OPT1__EGG         => 'https://tamreeni-backend.s3.amazonaws.com/egg-3x.png',
        self::Q16_OPT2__FISH        => 'https://tamreeni-backend.s3.amazonaws.com/fish-3x.png',
        self::Q16_OPT3__SHRIMP      => 'https://tamreeni-backend.s3.amazonaws.com/shrimp-3x.png',
        self::Q16_OPT4__DAIRY       => 'https://tamreeni-backend.s3.amazonaws.com/dairy-3x.png',
        self::Q16_OPT5__VEGIES      => 'https://tamreeni-backend.s3.amazonaws.com/veggies-3x.png',
        self::Q16_OPT6__SEA_FOOD    => 'https://tamreeni-backend.s3.amazonaws.com/seaFood-3x.png',

        self::Q21_OPTS1__SQUAT      => 'https://tamreeni-backend.s3.amazonaws.com/workoutHome-3x.png',
        self::Q21_OPTS2__DEADLIFT   => 'https://tamreeni-backend.s3.amazonaws.com/workoutHome-3x.png',
        self::Q21_OPTS3__BENCH      => 'https://tamreeni-backend.s3.amazonaws.com/workoutHome-3x.png',
        self::Q21_OPTS4__OVERHEAD   => 'https://tamreeni-backend.s3.amazonaws.com/workoutHome-3x.png',
    ];

    const Q1_OPT1__LOSE_WEIGHT  = 'lose_weight';
    const Q1_OPT2__GAIN_WEIGHT  = 'gain_weight';
    const Q1_OPT3__BUILD_MUSCLE = 'build_muscle';
    const Q1_OPT4__GET_FIT      = 'get_fit';

    const Q2_OPT1__MALE   = 'male';
    const Q2_OPT2__FEMALE = 'female';

    const Q7_OPT1__1_TO_2_DAYS_A_WEEK = '1_to_2_days_a_week';
    const Q7_OPT2__2_TO_4_DAYS_A_WEEK = '2_to_4_days_a_week';
    const Q7_OPT3__5_DAYS_A_WEEK      = '5_days_a_week';

    public static $DAYS_PER_WEEK = [
        self::Q7_OPT1__1_TO_2_DAYS_A_WEEK => 2,
        self::Q7_OPT2__2_TO_4_DAYS_A_WEEK => 4,
        self::Q7_OPT3__5_DAYS_A_WEEK      => 5
    ];

    const Q8_OPT1__5_TO_10_MINS_A_DAY  = '5_to_10_mins_a_day';
    const Q8_OPT2__10_TO_15_MINS_A_DAY = '10_to_15_mins_a_day';
    const Q8_OPT3__15_TO_20_MINS_A_DAY = '15_to_20_mins_a_day';

    const Q9_OPT1__HOME = 'home';
    const Q9_OPT2__GYM  = 'gym';

    const Q10_OPT1__ALL_EQUIPMENTS      = 'all_equipments';
    const Q10_OPT2__FREE_WEIGHT         = 'free_weight';
    const Q10_OPT3__MACHINES            = 'machines';
    const Q10_OPT4__NO_EQUIPMENT_AT_ALL = 'no_equipment_at_all';

    const Q11_OPT1__YES = 'yes';
    const Q11_OPT2__NO  = 'no';

    const Q12_OPT1__30_MINS          = '30_mins';
    const Q12_OPT2__45_MINS          = '45_mins';
    const Q12_OPT3__1_HOUR           = '1_hour';
    const Q12_OPT4__MORE_THAN_1_HOUR = 'more_than_1_hour';

    const Q14_OPT1__BACK  = 'back';
    const Q14_OPT2__ARMS  = 'arms';
    const Q14_OPT3__CHEST = 'chest';
    const Q14_OPT4__ABS   = 'abs';
    const Q14_OPT5__LEGS  = 'legs';

    const Q15_OPT1__TRADITIONAL = 'traditional';
    const Q15_OPT2__KETO        = 'keto';

    const Q16_OPT1__EGG      = 'egg';
    const Q16_OPT2__FISH     = 'fish';
    const Q16_OPT3__SHRIMP   = 'shrimp';
    const Q16_OPT4__DAIRY    = 'dairy';
    const Q16_OPT5__VEGIES   = 'vegies';
    const Q16_OPT6__SEA_FOOD = 'sea_food';

    const Q17_OPT1__BEGINNER     = 'beginner';
    const Q17_OPT2__INTERMEDIATE = 'intermediate';
    const Q17_OPT3__ADVANCED     = 'advanced';

    const Q18_OPT1__YES = 'yes';
    const Q18_OPT2__NO  = 'no';

    const Q19_OPT1__2000_4000_STEPS = '2000_4000_steps';
    const Q19_OPT2__5000_7000_STEPS = '5000_7000_steps';
    const Q19_OPT3__7000_10000      = '7000_10000_steps';
    const Q19_OPT3__10000_PLUS      = '10000_plus_steps';

    const Q20_OPT1__NOT_AT_ALL = 'not_at_all';
    const Q20_OPT2__1_to_2_WORKOUT_A_WEEK = '1_to_2_workout_a_week';
    const Q20_OPT3__2_to_4_WORKOUT_A_WEEK = '2_to_4_workout_a_week';
    const Q20_OPT4__4_to_6_WORKOUT_A_WEEK = '4_to_6_workout_a_week';

    const Q21_OPTS1__SQUAT      = 'squat__one_rep_max_in_kg';
    const Q21_OPTS2__DEADLIFT   = 'deadlift__one_rep_max_in_kg';
    const Q21_OPTS3__BENCH      = 'bench__one_rep_max_in_kg';
    const Q21_OPTS4__OVERHEAD   = 'overhead__one_rep_max_in_kg';


    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
