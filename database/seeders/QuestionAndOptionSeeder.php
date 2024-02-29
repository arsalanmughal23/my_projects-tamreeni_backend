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
        $questions = [
            [
                'title' => "What's your goal?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q1_GOAL,
                'options' => Question::Q1_OPTS
            ],
            [
                'title' => "What's your gender?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q2_GENDER,
                'options' => Question::Q2_OPTS
            ],
            [
                'title' => "When is your birthday?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'date',
                'question_variable_name' => Question::Q3_DOB
            ],
            [
                'title' => "What's your height?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'number_with_unit',
                'question_variable_name' => Question::Q4_HEIGHT_IN_M,
                'question_secondary_variable_name' => Question::Q4_SEC,
                'options' => Question::Q4_SEC_OPTS
            ],
            [
                'title' => "Tell us your current weight?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'number_with_unit',
                'question_variable_name' => Question::Q5_CURRENT_WEIGHT_IN_KG,
                'question_secondary_variable_name' => Question::Q5_SEC,
                'options' => Question::Q5_SEC_OPTS
            ],
            [
                'title' => "Your target weight?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'number_with_unit',
                'question_variable_name' => Question::Q6_TARGET_WEIGHT_IN_KG,
                'question_secondary_variable_name' => Question::Q6_SEC,
                'options' => Question::Q6_SEC_OPTS
            ],
            // [
            //     'title' => "How physically active you are?",
            //     'cover_image' => 'https://via.placeholder.com/640x480.png',
            //     'answer_mode' => 'single_select',
            //     'question_variable_name' => 'physically_active',
            //     'options' => ['not_at_all', '1_to_2_workout_a_week', '2_to_4_workout_a_week', '4_to_6_workout_a_week']
            // ],
            [
                'title' => "How many days do you want to workout in a week?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q7_WORKOUT_DAYS_IN_A_WEEK,
                'options' => Question::Q7_OPTS
            ],
            [
                'title' => "How much time do you want to workout a day?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q8_WORKOUT_DURATION_PER_DAY,
                'options' => Question::Q8_OPTS
            ],
            [
                'title' => "Where do you prefer to workout?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q9_WORKOUT_PREFERED_PLACE,
                'options' => Question::Q9_OPTS
            ],
            [
                'title' => "What type of equipment do you have?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q10_EQUIPMENT_TYPE,
                'options' => Question::Q10_OPTS
            ],
            [
                'title' => "Do you have a scale at home?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q11_HAVE_A_SCALE,
                'options' => Question::Q11_OPTS
            ],
            [
                'title' => "How long do you have time to workout?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q12_HOW_LONG_TIME_TO_WORKOUT,
                'options' => Question::Q12_OPTS
            ],
            [
                'title' => "When do you want to reach your goal by the date?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'date',
                'question_variable_name' => Question::Q13_REACH_GOAL_TARGET_DATE
            ],
            [
                'title' => "Which areas need the most attention?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'multi_select',
                'question_variable_name' => Question::Q14_BODY_PARTS,
                'options' => Question::Q14_OPTS
            ],
            [
                'title' => "Choose your diet type.",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q15_DIET_TYPE,
                'options' => Question::Q15_OPTS
            ],
            [
                'title' => "Select your food preferences.",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'multi_select',
                'question_variable_name' => Question::Q16_FOOD_PREFERENCES,
                'options' => Question::Q16_OPTS
            ],
            [
                'title' => "What level are you at?",
                'cover_image' => 'https://via.placeholder.com/640x480.png',
                'answer_mode' => 'single_select',
                'question_variable_name' => Question::Q17_LEVEL,
                'options' => Question::Q17_OPTS
            ]

        ];

        self::makeQuestion($questions);
    }
    
    public static function makeQuestion($questions)
    {
        
        collect($questions)->map(function ($question) {
            $questionOptions = $question['options'] ?? [];
            unset($question['options']);
            $createdQuestion = Question::create($question);
            
            if(count($questionOptions) > 0){
                collect($questionOptions)->map(function ($option) use($createdQuestion) {

                    $newOption['question_id'] = $createdQuestion?->id ?? null;
                    $newOption['question_variable_name'] = $createdQuestion?->question_variable_name ?? null;
                    $newOption['option_variable_name'] = $option;
                    $newOption['image'] = Option::OPTS_IMAGE[$option] ?? null;

                    $createdOption = Option::create($newOption);
                });
            }
        });
    }
}
