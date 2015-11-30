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
defined('MODULE_SURVEYSQUESTIONSSET') ? : define('MODULE_SURVEYSQUESTIONSSET', 'surveys-questions-set');
$config = [
	'modules' => [
		'surveys-questions-set' => [
			'enable' => true,
			'name' => 'Question Set',
			'class' => null,
			'config' => [],
			'route' => null,
			'access' => 'admin',
			'controller' => null,
			'method' => null,
			'attributes' => [
				'breadcrumbs' => []
			],
			'parent' => [
				'enable' => true,
				'request' => [
					'index' => ['record']
				],
				'route' => [
					[
						'record' => [
							'name' => 'Module',
							'module' => 'surveys'
						],
					]
				],
				'model' => [
					'value' => [
						'index' => ['survey_id']
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
					],
				],
				'error' => [
					'notfound' => 'Survey not found.'
				],
			],
			/**
			 * Actions
			 */
			'actions' => [
				'index' => [
					'enable' => true,
					'access' => 'admin',
					'view' => [
						'template' => false
					],
					'widgets' => ['surveysQuestionsSetData']
				],
				'update' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsSetForm']
				],
				'delete' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsSetForm']
				],
				'view' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsSetForm']
				],
				'duplicate' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsSetForm']
				],
				'create' => [
					'enable' => true,
					'widgets' => ['surveysQuestionsSetForm']
				],
			],
		]
	],
];
return array_merge_recursive($config, require __DIR__ . '/form.php', require __DIR__ . '/datatable.php');
