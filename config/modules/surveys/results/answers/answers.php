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
defined('MODULE_SURVEYSRESULTSANSWERS') ? : define('MODULE_SURVEYSRESULTSANSWERS', 'surveys-results-answers');
$config = [
	'modules' => [
		'surveys-results-answers' => [
			'enable' => true,
			'name' => 'Survey Result',
			/**
			 * Class to be used to instantiate this module
			 * instanceof /Model/Module/ModuleInterface
			 * @var string|null
			 */
			'class' => null,
			'metas' => [
				'pagetitle' => 'Survey Result',
				'pagesubtitle' => 'View Survey Result'
			],
			'breadcrumb' => [
				'nav::surveys',
				'nav::surveys.children.results',
				'nav::surveys.children.results.children.answers',
			],
			'access' => 'salesman',
			/**
			 * FEtch Parent Record
			 * Fetch/Check a record when this action is loaded
			 * @see Traits/Repository::fetchRecord
			 */
			'parent' => [
				'enable' => true,
				'request' => [
					'index' => ['record']
				],
				'route' => [
					[
						'record' => [
							'name' => 'Module',
							'module' => 'surveys',

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
				/**
				 * Error, if not found,
				 */
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
					'view' => [
						'template' => false
					],
					'widgets' => ['surveyAnswer']
				],
				'print' => [
					'enable' => true,
					'view' => [
						'template' => false
					],
					'widgets' => ['surveyAnswer']
				],
			],
		]
	],
];
return array_merge_recursive($config, []);
