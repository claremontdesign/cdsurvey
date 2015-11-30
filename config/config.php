<?php

return [
	'widgets' => [
		'classes' => [
			'survey' => [
				'class' => \Claremontdesign\Cdsurvey\Widgets\WidgetTypes\Survey::class
			],
		],
	],
	// database.surveys.answerOptions.
	'database' => [
		'surveys' => [
			'surveys' => [
				'table' => [
					'name' => 'surveys',
					'primary' => 'survey_id',
				],
				'model' => [
					'class' => Claremontdesign\Cdsurvey\Model\Survey::class,
					'fillable' => ['title', 'description', 'status', 'start_at', 'end_at'],
				],
				'repository' => [
					'class' => Claremontdesign\Cdsurvey\Model\Repository\Survey::class
				]
			],
			'result' => [
				'table' => [
					'name' => 'surveys_result',
					'primary' => 'result_id',
				],
				'model' => [
					'class' => Claremontdesign\Cdsurvey\Model\Result::class,
					'fillable' => ['survey_id', 'customer_id', 'question_id', 'answer', 'start_at', 'end_at'],
				],
				'repository' => [
					'class' => Claremontdesign\Cdsurvey\Model\Repository\Result::class
				]
			],
			'questions' => [
				'table' => [
					'name' => 'survey_questions',
					'primary' => 'question_id',
				],
				'model' => [
					'class' => Claremontdesign\Cdsurvey\Model\Question::class,
					'fillable' => ['title', 'description', 'type', 'survey_id', 'question_set_id', 'status', 'position'],
				],
				'repository' => [
					'class' => Claremontdesign\Cdsurvey\Model\Repository\Question::class
				]
			],
			'answer' => [
				'table' => [
					'name' => 'survey_questions_answers',
					'primary' => 'answer_id',
				],
				'model' => [
					'class' => Claremontdesign\Cdsurvey\Model\Answer::class,
					'fillable' => ['question_id', 'required', 'status', 'answer_type', 'label', 'description', 'position'],
				],
				'repository' => [
					'class' => Claremontdesign\Cdsurvey\Model\Repository\Answer::class
				]
			],
			'answerOptions' => [
				'table' => [
					'name' => 'survey_questions_answers_options',
					'primary' => 'option_id',
				],
				'model' => [
					'class' => Claremontdesign\Cdsurvey\Model\AnswerOption::class,
					'fillable' => ['answer_id', 'option_name', 'option_value', 'status', 'position'],
				],
				'repository' => [
					'class' => Claremontdesign\Cdsurvey\Model\Repository\AnswerOption::class
				]
			],
			'questionSet' => [
				'table' => [
					'name' => 'survey_questions_set',
					'primary' => 'question_set_id',
				],
				'model' => [
					'class' => Claremontdesign\Cdsurvey\Model\QuestionSet::class,
					'fillable' => ['survey_id', 'title', 'description', 'status', 'position'],
				],
				'repository' => [
					'class' => Claremontdesign\Cdsurvey\Model\Repository\QuestionSet::class
				]
			],
		],
	],
];
