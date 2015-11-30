<?php

use Illuminate\Database\Seeder;

class SurveyTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(cd_config('database.surveys.surveys.model.class'), 2)->create()->each(function($survey) {
			factory(cd_config('database.surveys.questions.model.class'), rand(2, 10))->create()->each(function($question) use ($survey) {
				$survey->questions()->save($question);
				$count = rand(1, 2);
				if($count > 1)
				{
					factory(cd_config('database.surveys.answer.model.class'), $count)->create()->each(function($answer) use($question) {
						$question->answers()->save($answer);
						if($answer instanceof \Claremontdesign\Cdsurvey\Model\Answer)
						{
							$optionable = $answer->optionable();
							if(!empty($optionable))
							{
								factory(cd_config('database.surveys.answerOptions.model.class'), 4)->create()->each(function($option) use($answer) {
									if($option instanceof \Claremontdesign\Cdsurvey\Model\AnswerOption)
									{
										$answer->options()->save($option);
									}
							});
							}
						}
					});
				}
				else
				{
					$answer = factory(cd_config('database.surveys.answer.model.class'), $count)->create();
					$question->answers()->save($answer);
					if($answer instanceof \Claremontdesign\Cdsurvey\Model\Answer)
					{
						$optionable = $answer->optionable();
						if(!empty($optionable))
						{
							factory(cd_config('database.surveys.answerOptions.model.class'), 4)->create()->each(function($option) use($answer) {
								if($option instanceof \Claremontdesign\Cdsurvey\Model\AnswerOption)
								{
									$answer->options()->save($option);
								}
							});
						}
					}
				}
			});
		});
	}

}
