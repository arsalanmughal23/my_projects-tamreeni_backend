<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionAndOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::truncate();
        Option::truncate();

        $questions = [
            [
                'title'                  => Question::Q1_GOAL,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q1_GOAL,
                'options'                => Question::Q1_OPTS,
                'position'               => 1
            ],
            [
                'title'                  => Question::Q2_GENDER,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q2_GENDER,
                'options'                => Question::Q2_OPTS,
                'position'               => 2
            ],
            [
                'title'                  => Question::Q3_DOB,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'date',
                'question_variable_name' => Question::Q3_DOB,
                'position'               => 3
            ],
            [
                'title'                            => Question::Q4_HEIGHT,
                'cover_image'                      => 'https://via.placeholder.com/640x480.png',
                'answer_mode'                      => 'number_with_unit',
                'question_variable_name'           => Question::Q4_HEIGHT,
                'question_secondary_variable_name' => Question::Q4_SEC,
                'options'                          => Question::Q4_SEC_OPTS,
                'position'                         => 4
            ],
            [
                'title'                            => Question::Q5_CURRENT_WEIGHT,
                'cover_image'                      => 'https://via.placeholder.com/640x480.png',
                'answer_mode'                      => 'number_with_unit',
                'question_variable_name'           => Question::Q5_CURRENT_WEIGHT,
                'question_secondary_variable_name' => Question::Q5_SEC,
                'options'                          => Question::Q5_SEC_OPTS,
                'position'                         => 5
            ],
            [
                'title'                            => Question::Q6_TARGET_WEIGHT,
                'cover_image'                      => 'https://via.placeholder.com/640x480.png',
                'answer_mode'                      => 'number_with_unit',
                'question_variable_name'           => Question::Q6_TARGET_WEIGHT,
                'question_secondary_variable_name' => Question::Q6_SEC,
                'options'                          => Question::Q6_SEC_OPTS,
                'position'                         => 6
            ],
            [
                'title'                  => Question::Q7_WORKOUT_DAYS_IN_A_WEEK,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q7_WORKOUT_DAYS_IN_A_WEEK,
                'options'                => Question::Q7_OPTS,
                'position'               => 7
            ],
            [
                'title'                  => Question::Q8_WORKOUT_DURATION_PER_DAY,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q8_WORKOUT_DURATION_PER_DAY,
                'options'                => Question::Q8_OPTS,
                'position'               => 8
            ],
            [
                'title'                  => Question::Q9_WORKOUT_PREFERED_PLACE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q9_WORKOUT_PREFERED_PLACE,
                'options'                => Question::Q9_OPTS,
                'position'               => 9
            ],
            [
                'title'                  => Question::Q10_EQUIPMENT_TYPE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q10_EQUIPMENT_TYPE,
                'options'                => Question::Q10_OPTS,
                'position'               => 10
            ],
            [
                'title'                  => Question::Q11_HAVE_A_SCALE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q11_HAVE_A_SCALE,
                'options'                => Question::Q11_OPTS,
                'position'               => 11
            ],
            [
                'title'                  => Question::Q12_HOW_LONG_TIME_TO_WORKOUT,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q12_HOW_LONG_TIME_TO_WORKOUT,
                'options'                => Question::Q12_OPTS,
                'position'               => 12
            ],
            [
                'title'                  => Question::Q13_REACH_GOAL_TARGET_DATE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'date',
                'question_variable_name' => Question::Q13_REACH_GOAL_TARGET_DATE,
                'position'               => 13
            ],
            [
                'title'                  => Question::Q14_BODY_PARTS,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'multi_select',
                'question_variable_name' => Question::Q14_BODY_PARTS,
                'options'                => Question::Q14_OPTS,
                'position'               => 14
            ],
            [
                'title'                  => Question::Q17_LEVEL,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q17_LEVEL,
                'options'                => Question::Q17_OPTS,
                'position'               => 15
            ],
            [
                'title'                  => Question::Q18_HEALTH_STATUS,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q18_HEALTH_STATUS,
                'options'                => Question::Q18_OPTS,
                'position'               => 16
            ],
            [
                'title'                  => Question::Q19_DAILY_STEPS_TAKEN,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q19_DAILY_STEPS_TAKEN,
                'options'                => Question::Q19_OPTS,
                'position'               => 17
            ],
            [
                'title'                  => Question::Q20_PHYSICALLY_ACTIVE,//"How physically active you are?",
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q20_PHYSICALLY_ACTIVE,//'physically_active',
                'options'                => Question::Q20_OPTS,//['not_at_all', '1_to_2_workout_a_week', '2_to_4_workout_a_week', '4_to_6_workout_a_week'],
                'position'               => 18
            ],
            [
                'title'                  => Question::Q21_ONE_REP_MAX_WEIGHT,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'multi_input_number',
                'question_variable_name' => Question::Q21_ONE_REP_MAX_WEIGHT,
                'options'                => Question::Q21_OPTS_MULTI_INPUT,
                'position'               => 19
            ],
            [
                'title'                  => Question::Q15_DIET_TYPE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q15_DIET_TYPE,
                'options'                => Question::Q15_OPTS,
                'position'               => 20
            ],
            [
                'title'                  => Question::Q16_FOOD_PREFERENCES,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'multi_select',
                'question_variable_name' => Question::Q16_FOOD_PREFERENCES,
                'options'                => Question::Q16_OPTS,
                'position'               => 21
            ],
        ];

        self::makeQuestion($questions);
    }

    public static function makeQuestion($questions)
    {

        collect($questions)->map(function ($question) {
            $questionOptions = $question['options'] ?? [];
            unset($question['options']);
            $question['title'] = [
                'en' => __('questions.'.$question['title'], [], 'en'),
                'ar' => __('questions.'.$question['title'], [], 'ar')
            ];
            $createdQuestion = Question::create($question);

            if (count($questionOptions) > 0) {
                collect($questionOptions)->map(function ($option) use ($createdQuestion) {

                    $newOption['question_id'] = $createdQuestion?->id ?? null;
                    $newOption['question_variable_name'] = $createdQuestion ?->question_variable_name ?? null;
                    $newOption['option_variable_name'] = $option;
                    $newOption['image']                = Option::OPTS_IMAGE[$option] ?? null;
                    $newOption['title']                = [
                        'en' => __('options.'.$option, [], 'en'),
                        'ar' => __('options.'.$option, [], 'ar')
                    ];

                    $createdOption = Option::create($newOption);
                });
            }
        });
    }
}
