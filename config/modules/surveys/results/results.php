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
defined('MODULE_SURVEYSRESULTS') ? : define('MODULE_SURVEYSRESULTS', 'surveys-results');
$config = [
	'modules' => [
		/**
		 * admin/moduleIndex/actionIndex/taskIndex/recordIndex
		 * each module is an instanceof /Module/ModuleInterface
		 *
		 * AttributableInterface, ConfigurableInterface, AccessibleInterface
		 */
		'surveys-results' => [
			'enable' => true,
			/**
			 * Module displayable name
			 * @var string
			 */
			'name' => 'Survey Results',
			/**
			 * Class to be used to instantiate this module
			 * instanceof /Model/Module/ModuleInterface
			 * @var string|null
			 */
			'class' => null,
			'metas' => [
				'pagetitle' => 'Survey Results',
				'pagesubtitle' => 'Manage Survey Results.'
			],
			'breadcrumb' => [
				'nav::surveys',
				'nav::surveys.children.results',
			],
			/**
			 * Module-specific configuration.
			 * Will be injected to the module
			 * instanceof Collection
			 * @var array|null
			 */
			'config' => [],
			/**
			 * Route to use for this Module
			 * If not empty, this will be skip in admin route generation
			 * @var string|null
			 */
			'route' => null,
			/**
			 * The minimum access level.
			 * 	If array, set of access level and not minimum access level
			 *  access levels are: guest, user, editor, moderator, admin, superadmin, sudo
			 */
			'access' => 'salesman',
			/**
			 * The moduleIndex controller to be used.
			 * instanceof /Http/Controllers/ModuleControllerInterface
			 * @var string|null
			 */
			'controller' => null,
			/**
			 * The moduleIndex method to use
			 * @var string|null default to 'index'; see 'actions'
			 */
			'method' => null,
			/**
			 * Module Attributes
			 */
			'attributes' => [
				'breadcrumbs' => []
			],
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
				/**
				 * All module properties can be inherited by an anction
				 * AttributableInterface, ConfigurableInterface, AccessibleInterface, Viewable
				 */
				'index' => [
					/**
					 * Enable/Disable this action
					 */
					'enable' => true,
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
					'widgets' => ['surveysResultsData']
				],
			],
		]
	],
];
return array_merge_recursive($config, require __DIR__ . '/datatable.php');
