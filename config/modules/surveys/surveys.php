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
defined('MODULE_SURVEYS') ? : define('MODULE_SURVEYS', 'surveys');
$config = [
	'modules' => [
		/**
		 * admin/moduleIndex/actionIndex/taskIndex/recordIndex
		 * each module is an instanceof /Module/ModuleInterface
		 *
		 * AttributableInterface, ConfigurableInterface, AccessibleInterface
		 */
		'surveys' => [
			'enable' => true,
			/**
			 * Module displayable name
			 * @var string
			 */
			'name' => 'Surveys',
			/**
			 * Class to be used to instantiate this module
			 * instanceof /Model/Module/ModuleInterface
			 * @var string|null
			 */
			'class' => null,
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
			'access' => 'admin',
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
					'widgets' => ['surveysData']
				],
				'update' => [
					'enable' => true,
					'widgets' => ['surveysForm']
				],
				'delete' => [
					'enable' => true,
					'widgets' => ['surveysForm']
				],
				'view' => [
					'enable' => true,
					'widgets' => ['surveysForm']
				],
				'duplicate' => [
					'enable' => true,
					'widgets' => ['surveysForm']
				],
				'create' => [
					'enable' => true,
					'widgets' => ['surveysForm']
				],
			],
		]
	],
];
return array_merge_recursive(
		$config, require __DIR__ . '/../../widgets/survey.php', require __DIR__ . '/form.php', require __DIR__ . '/datatable.php', require __DIR__ . '/questions/questions.php', require __DIR__ . '/questions/set/set.php', require __DIR__ . '/answer/answer.php', require __DIR__ . '/answer/options/options.php'
);
