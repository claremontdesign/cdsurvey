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
 *
 * Example of a Module
 */
defined('MODULE_SURVEYSQUESTIONSANSWEROPTION') ? : define('MODULE_SURVEYSQUESTIONSANSWEROPTION', 'surveys-questions-answer-options');
$config = [
	'modules' => [
		'surveys-questions-answers-options' => [
			'enable' => true,
			'name' => 'Answer Options',
			'metas' => [
				'pagetitle' => 'Answer Options',
				'pagesubtitle' => 'Some answers can have selections and options.'
			],
			'breadcrumb' => [
				'nav::surveys',
				'nav::surveys.children.questions',
				'nav::surveys.children.questions.children.answers',
				'nav::surveys.children.questions.children.answers.children.options',
			],
			'access' => 'admin',
			'parent' => [
				'enable' => true,
				'request' => [
					'index' => ['record', 'paramOne', 'paramTwo']
				],
				'route' => [
					[
						'record' => [
							'name' => 'Module',
							'module' => 'surveys'
						],
						'paramOne' => [
							'name' => 'Module',
							'module' => 'surveys-questions'
						],
						'paramTwo' => [
							'name' => 'Module',
							'module' => 'surveys-questions-answers'
						]
					]
				],
				'model' => [
					'value' => [
						'index' => ['survey_id', 'question_id', 'answer_type_id']
					],
					'repository' => [
						'record' => [
							'index' => cd_config('database.surveys.surveys.table.name') . '.' . cd_config('database.surveys.surveys.table.primary'),
							'class' => cd_config('database.surveys.surveys.model.class'),
							'repository' => [
								'class' => cd_config('database.surveys.surveys.repository.class'),
								'index' => cd_config('database.surveys.surveys.table.name') . '.' . cd_config('database.surveys.surveys.table.primary'),
							]
						],
						'paramOne' => [
							'index' => cd_config('database.surveys.questions.table.name') . '.' . cd_config('database.surveys.questions.table.primary'),
							'class' => cd_config('database.surveys.questions.model.class'),
							'repository' => [
								'class' => cd_config('database.surveys.questions.repository.class'),
								'index' => cd_config('database.surveys.questions.table.name') . '.' . cd_config('database.surveys.questions.table.primary'),
							]
						],
						'paramTwo' => [
							'index' => cd_config('database.surveys.answer.table.name') . '.' . cd_config('database.surveys.answer.table.primary'),
							'class' => cd_config('database.surveys.answer.model.class'),
							'repository' => [
								'class' => cd_config('database.surveys.answer.repository.class'),
								'index' => cd_config('database.surveys.answer.table.name') . '.' . cd_config('database.surveys.answer.table.primary'),
							]
						],
					],
				],
				'error' => [
					'notfound' => [
						'record' => 'Survey not found.',
						'paramOne' => 'Survey Question not found.',
						'paramTwo' => 'Answer not found.',
					],
				],
			],
			'actions' => [
				'index' => [
					'enable' => true,
					'access' => 'admin',
					'view' => [
						'template' => false
					],
					'widgets' => ['surveysQuestionsAnswersOptionData']
				],
				'update' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersOptionForm']
				],
				'delete' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersOptionForm']
				],
				'view' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersOptionForm']
				],
				'duplicate' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersOptionForm']
				],
				'create' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersOptionForm'],
					'metas' => [
						'pagetitle' => 'Create an Answer option.',
						'pagesubtitle' => 'Create a new Answer option.'
					],
				],
			],
		]
	],
];
return array_merge_recursive($config, require __DIR__ . '/form.php', require __DIR__ . '/datatable.php');
