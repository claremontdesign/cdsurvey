<?php

/**
 * Dx
 *
 * @link http://dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2015 ClaremontDesign/MadLabs-Dx
 * @version 0.0.0.1
 * @since Nov 7, 2015 1:25:03 PM
 * @file config.php
 * @project Cdbackend
 */
return [
	/**
	 * Collection of Widgets that this module is offered
	 * each widget is a content on itself.
	 * a datatable, a form, a button
	 * each is an instanceof /Widget/WidgetInterface
	 * AttributableInterface, ConfigurableInterface, AccessibleInterface, ViewableInterface,
	 * 		Modelable,
	 */
	'widgets' => [
		'einkspreadSurvey' => [
			'access' => 'guest',
			'enable' => true,
			'type' => 'survey',
			'messages' => [
				'empty' => [
					'empty' => 'No data found.',
					'notfound' => 'Cannot find the record/s you are looking for. Kindly try again.'
				],
			],
			'config' => [
				'attributes' => [
					'recordName' => [
						'singular' => 'Survey',
						'plural' => 'Surveys'
					],
				],
				'questions' => [
					/**
					 * Use set of questions instead of displaying each quests
					 * if true, questions will be displayed by set and not by questions
					 */
					'set' => true,
					'display' => [
						'questionsPerPage' => 1,
					],
				],
			],
			'models' => [
				'survey' => [
					'primaryKey' => cd_config('database.surveys.table.primary'),
					'class' => cd_config('database.surveys.model.class'),
					'repository' => [
						'class' => cd_config('database.surveys.repository.class')
					],
				],
				'questions' => [
					'primaryKey' => cd_config('database.surveysQuestions.table.primary'),
					'class' => cd_config('database.surveysQuestions.model.class'),
					'repository' => [
						'class' => cd_config('database.surveysQuestions.repository.class')
					],
				],
				'questionsSet' => [
					'primaryKey' => cd_config('database.surveysQuestionsSet.table.primary'),
					'class' => cd_config('database.surveysQuestionsSet.model.class'),
					'repository' => [
						'class' => cd_config('database.surveysQuestionsSet.repository.class')
					],
				],
				'answers' => [
					'primaryKey' => cd_config('database.surveysQuestionsAnswer.table.primary'),
					'class' => cd_config('database.surveysQuestionsAnswer.model.class'),
					'repository' => [
						'class' => cd_config('database.surveysQuestionsAnswer.repository.class')
					],
				],
				'answerOptions' => [
					'primaryKey' => cd_config('database.surveysQuestionsAnswerOptions.table.primary'),
					'class' => cd_config('database.surveysQuestionsAnswerOptions.model.class'),
					'repository' => [
						'class' => cd_config('database.surveysQuestionsAnswerOptions.repository.class')
					],
				],
				'result' => [
					'primaryKey' => cd_config('database.surveysResult.table.primary'),
					'class' => cd_config('database.surveysResult.model.class'),
					'repository' => [
						'class' => cd_config('database.surveysResult.repository.class')
					],
				]
			],
		]
	],
];
