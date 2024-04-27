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
                'options'                => Question::Q1_OPTS
            ],
            [
                'title'                  => Question::Q2_GENDER,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q2_GENDER,
                'options'                => Question::Q2_OPTS
            ],
            [
                'title'                  => Question::Q3_DOB,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'date',
                'question_variable_name' => Question::Q3_DOB
            ],
            [
                'title'                            => Question::Q4_HEIGHT_IN_M,
                'cover_image'                      => 'https://via.placeholder.com/640x480.png',
                'answer_mode'                      => 'number_with_unit',
                'question_variable_name'           => Question::Q4_HEIGHT_IN_M,
                'question_secondary_variable_name' => Question::Q4_SEC,
                'options'                          => Question::Q4_SEC_OPTS
            ],
            [
                'title'                            => Question::Q5_CURRENT_WEIGHT_IN_KG,
                'cover_image'                      => 'https://via.placeholder.com/640x480.png',
                'answer_mode'                      => 'number_with_unit',
                'question_variable_name'           => Question::Q5_CURRENT_WEIGHT_IN_KG,
                'question_secondary_variable_name' => Question::Q5_SEC,
                'options'                          => Question::Q5_SEC_OPTS
            ],
            [
                'title'                            => Question::Q6_TARGET_WEIGHT_IN_KG,
                'cover_image'                      => 'https://via.placeholder.com/640x480.png',
                'answer_mode'                      => 'number_with_unit',
                'question_variable_name'           => Question::Q6_TARGET_WEIGHT_IN_KG,
                'question_secondary_variable_name' => Question::Q6_SEC,
                'options'                          => Question::Q6_SEC_OPTS
            ],
            // [
            //     'title' => "How physically active you are?",
            //     'cover_image' => 'https://via.placeholder.com/640x480.png',
            //     'answer_mode' => 'single_select',
            //     'question_variable_name' => 'physically_active',
            //     'options' => ['not_at_all', '1_to_2_workout_a_week', '2_to_4_workout_a_week', '4_to_6_workout_a_week']
            // ],
            [
                'title'                  => Question::Q7_WORKOUT_DAYS_IN_A_WEEK,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q7_WORKOUT_DAYS_IN_A_WEEK,
                'options'                => Question::Q7_OPTS
            ],
            [
                'title'                  => Question::Q8_WORKOUT_DURATION_PER_DAY,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q8_WORKOUT_DURATION_PER_DAY,
                'options'                => Question::Q8_OPTS
            ],
            [
                'title'                  => Question::Q9_WORKOUT_PREFERED_PLACE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q9_WORKOUT_PREFERED_PLACE,
                'options'                => Question::Q9_OPTS
            ],
            [
                'title'                  => Question::Q10_EQUIPMENT_TYPE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q10_EQUIPMENT_TYPE,
                'options'                => Question::Q10_OPTS
            ],
            [
                'title'                  => Question::Q11_HAVE_A_SCALE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q11_HAVE_A_SCALE,
                'options'                => Question::Q11_OPTS
            ],
            [
                'title'                  => Question::Q12_HOW_LONG_TIME_TO_WORKOUT,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q12_HOW_LONG_TIME_TO_WORKOUT,
                'options'                => Question::Q12_OPTS
            ],
            [
                'title'                  => Question::Q13_REACH_GOAL_TARGET_DATE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'date',
                'question_variable_name' => Question::Q13_REACH_GOAL_TARGET_DATE
            ],
            [
                'title'                  => Question::Q14_BODY_PARTS,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'multi_select',
                'question_variable_name' => Question::Q14_BODY_PARTS,
                'options'                => Question::Q14_OPTS
            ],
            [
                'title'                  => Question::Q15_DIET_TYPE,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q15_DIET_TYPE,
                'options'                => Question::Q15_OPTS
            ],
            [
                'title'                  => Question::Q16_FOOD_PREFERENCES,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'multi_select',
                'question_variable_name' => Question::Q16_FOOD_PREFERENCES,
                'options'                => Question::Q16_OPTS
            ],
            [
                'title'                  => Question::Q17_LEVEL,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q17_LEVEL,
                'options'                => Question::Q17_OPTS
            ],
            [
                'title'                  => Question::Q18_HEALTH_STATUS,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q18_HEALTH_STATUS,
                'options'                => Question::Q18_OPTS
            ],
            [
                'title'                  => Question::Q19_DAILY_STEPS_TAKEN,
                'cover_image'            => 'https://via.placeholder.com/640x480.png',
                'answer_mode'            => 'single_select',
                'question_variable_name' => Question::Q19_DAILY_STEPS_TAKEN,
                'options'                => Question::Q19_OPTS
            ]

        ];

        self::makeQuestion($questions);
    }

    public static function makeQuestion($questions)
    {

        collect($questions)->map(function ($question) {
            $questionOptions = $question['options'] ?? [];
            unset($question['options']);
            $question['title'] = json_encode([
                'en' => __('questions.'.$question['title'], [], 'en'),
                'ar' => __('questions.'.$question['title'], [], 'ar')
            ]);
            $createdQuestion = Question::create($question);

            if (count($questionOptions) > 0) {
                collect($questionOptions)->map(function ($option) use ($createdQuestion) {

                    $newOption['question_id'] = $createdQuestion?->id ?? null;
                    $newOption['question_variable_name'] = $createdQuestion ?->question_variable_name ?? null;
                    $newOption['option_variable_name'] = $option;
                    $newOption['title']                = json_encode([
                        'en' => __('options.'.$option, [], 'en'),
                        'ar' => __('options.'.$option, [], 'ar')
                    ]);
                    $newOption['image']                = Option::OPTS_IMAGE[$option] ?? null;

                    $createdOption = Option::create($newOption);
                });
            }
        });
    }
}
