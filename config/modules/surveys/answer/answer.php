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
defined('MODULE_SURVEYSQUESTIONSANSWERTYPE') ? : define('MODULE_SURVEYSQUESTIONSANSWERTYPE', 'surveys-questions-answer');
$config = [
	'modules' => [
		/**
		 * admin/moduleIndex/actionIndex/taskIndex/recordIndex
		 * each module is an instanceof /Module/ModuleInterface
		 *
		 * AttributableInterface, ConfigurableInterface, AccessibleInterface
		 */
		'surveys-questions-answers' => [
			'enable' => true,
			/**
			 * Module displayable name
			 * @var string
			 */
			'name' => 'Answers',
			/**
			 * The minimum access level.
			 * 	If array, set of access level and not minimum access level
			 *  access levels are: guest, user, editor, moderator, admin, superadmin, sudo
			 */
			'access' => 'admin',
			/**
			 * FEtch Parent Record
			 * Fetch/Check a record when this action is loaded
			 * @see Traits/Repository::fetchRecord
			 */
			'parent' => [
				'enable' => true,
				'request' => [
					'index' => ['record', 'paramOne']
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
						]
					]
				],
				'model' => [
					'value' => [
						'index' => ['survey_id', 'question_id']
					],
					'repository' => [
						'record' => [
							'index' => cd_config('database.surveys.table.name') . '.' . cd_config('database.surveys.table.primary'),
							'class' => cd_config('database.surveys.model.class'),
							'repository' => [
								'class' => cd_config('database.surveys.repository.class'),
								'index' => cd_config('database.surveys.table.name') . '.' . cd_config('database.surveys.table.primary'),
							]
						],
						'paramOne' => [
							'index' => cd_config('database.surveysQuestions.table.name') . '.' . cd_config('database.surveysQuestions.table.primary'),
							'class' => cd_config('database.surveysQuestions.model.class'),
							'repository' => [
								'class' => cd_config('database.surveysQuestions.repository.class'),
								'index' => cd_config('database.surveysQuestions.table.name') . '.' . cd_config('database.surveysQuestions.table.primary'),
							]
						],
					],
				],
				/**
				 * Error, if not found,
				 */
				'error' => [
					'notfound' => [
						'record' => 'Survey not found.',
						'paramOne' => 'Survey Question not found.',
					],
				],
			],
			/**
			 * Actions
			 */
			'actions' => [
				/**
				 * All module properties can be inherited by an anction
				 * AttributableInterface, ConfigurableInterface, AccessibleInterface, Viewable
				 */
				'index' => [
					/**
					 * Enable/Disable this action
					 */
					'enable' => true,
					'access' => 'admin',
					/**
					 * View configuration for this actionIndex
					 */
					'view' => [
						/**
						 * The viewTemplate to use.
						 * should be the final template name e.g. cd_cdbase_view_name('view.file')
						 */
						'template' => false
					],
					/**
					 * Dynamic Contents to be displayed on this /moduleIndex/actionIndex
					 * Array of widgetIndex
					 */
					'widgets' => ['surveysQuestionsAnswersTypeData']
				],
				'update' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersTypeForm']
				],
				'delete' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersTypeForm']
				],
				'view' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersTypeForm']
				],
				'duplicate' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersTypeForm']
				],
				'create' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsAnswersTypeForm']
				],
			],
		]
	],
];
return array_merge_recursive($config, require __DIR__ . '/form.php', require __DIR__ . '/datatable.php');
