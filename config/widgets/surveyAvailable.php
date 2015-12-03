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
 * @project Cdsurvey
 */
return [
	'widgets' => [
		/**
		 * Displays the current available Surveys
		 */
		'surveyAvailable' => [
			'access' => 'guest',
			'enable' => true,
			'type' => 'survey',
			'messages' => [
				'empty' => [
					'empty' => 'No Surveys  found.',
					'notfound' => 'Cannot find the survey/s you are looking for. Kindly try again.'
				],
			],
			'questions' => [
				/**
				 * Use set of questions instead of displaying each quests
				 * if true, questions will be displayed by set and not by questions
				 */
				'set' => false
			],
			'request' => [
				'index' => 'record',
			],
			'url' => [
				'route' => [
					'name' => 'Module',
					'module' => 'surveys',
					'action' => 'customer',
				],
			],
			'models' => [
				'surveys' => [
					'primaryKey' => cd_config('database.surveys.surveys.table.primary'),
					'class' => cd_config('database.surveys.surveys.model.class'),
					'repository' => [
						'class' => cd_config('database.surveys.surveys.repository.class')
					],
				],
				'questions' => [
					'primaryKey' => cd_config('database.surveys.questions.table.primary'),
					'class' => cd_config('database.surveys.questions.model.class'),
					'repository' => [
						'perpage' => 2,
						'class' => cd_config('database.surveys.questions.repository.class')
					],
				],
				'questionsSet' => [
					'primaryKey' => cd_config('database.surveys.questionSet.table.primary'),
					'class' => cd_config('database.surveys.questionSet.model.class'),
					'repository' => [
						'perpage' => 1,
						'class' => cd_config('database.surveys.questionSet.repository.class')
					],
				],
				'answers' => [
					'primaryKey' => cd_config('database.surveys.answer.table.primary'),
					'class' => cd_config('database.surveys.answer.model.class'),
					'repository' => [
						'class' => cd_config('database.surveys.answer.repository.class')
					],
				],
				'answerOptions' => [
					'primaryKey' => cd_config('database.surveys.answerOptions.table.primary'),
					'class' => cd_config('database.surveys.answerOptions.model.class'),
					'repository' => [
						'class' => cd_config('database.surveys.answerOptions.repository.class')
					],
				],
				'result' => [
					'primaryKey' => cd_config('database.surveys.result.table.primary'),
					'class' => cd_config('database.surveys.result.model.class'),
					'repository' => [
						'class' => cd_config('database.surveys.result.repository.class')
					],
				],
				'resultAnswers' => [
					'primaryKey' => cd_config('database.surveys.resultAnswers.table.primary'),
					'class' => cd_config('database.surveys.resultAnswers.model.class'),
					'repository' => [
						'class' => cd_config('database.surveys.resultAnswers.repository.class')
					],
				]
			],
		]
	],
];
