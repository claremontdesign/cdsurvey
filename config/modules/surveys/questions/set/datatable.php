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
		'surveysQuestionsSetData' => [
			/**
			 * The widget base route
			 * If module/action/task is given, route will be generated
			 * if url is given, will use URL instead
			 */
			'access' => 'admin',
			'enable' => true,
			'type' => 'datatable',
			'sortable' => [
				'enable' => true
			],
			'messages' => [
				'empty' => [
					'empty' => 'No Question Set found.',
					'notfound' => 'Cannot find the question set you are looking for. Kindly try again.'
				],
			],
			'config' => [
				'attributes' => [
					'recordName' => [
						'singular' => 'Survey Question Set',
						'plural' => 'Surveys Question Sets'
					],
				],
			],
			/**
			 * Datatable CRUD Setup
			 */
			'request' => [
				/**
				 * The request name/index to be used as a route parameter for each row
				 * to forward row from page to page
				 */
				'index' => 'paramOne',
			],
			'toolbars' => [
				'topleft' => [
					'create' => [
						'enable' => true,
						'attributes' => [
							'label' => 'New Question Set',
						],
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-questions-set',
								'action' => 'create',
								'record' => function(){
							return \Route::input('record');
								}
							],
						],
					],
				],
			],
			'action' => [
				'enable' => true,
				'route' => [
					/**
					 * Route will be generated using the module settings
					 * each ACTION is an action of a module.
					 * each ACTION can also pass its own route setup
					 */
					'name' => 'Module',
					'module' => 'surveys-questions-set'
				],
				'actions' => [
//					'Questions' => [
//						'enable' => true,
//						'url' => [
//							'route' => [
//								'name' => 'Module',
//								'module' => 'surveys-questions',
//								'action' => 'index'
//							]
//						],
//					],
					'update' => [
						'enable' => true,
					],
					'delete' => [
						'enable' => true,
					],
					'view' => [
						'enable' => true,
					],
				],
			],
			/**
			 * Each is an instanceof /Widget/Datatable/ColumnInterface
			 * Columnnable, Attributable, Uitable, Htmlable
			 */
			'columns' => [
				'id' => [
					/**
					 * The name of DB tableColumn, if joint tables,
					 * 	include the DB column prefix
					 * default to columnIndex
					 */
					'enable' => false,
					'index' => cd_config('database.surveys.questionSet.table.primary'),
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.questionSet.table.name') . '.' . cd_config('database.surveys.questionSet.table.primary')
					],
					'sort' => [
						'enable' => true,
						'index' => cd_config('database.surveys.questionSet.table.name') . '.' . cd_config('database.surveys.questionSet.table.primary')
					],
					/**
					 * Type of column
					 * The value that this column has to display
					 */
					'type' => 'integer',
					'attributes' => [
						'label' => 'ID',
					],
					/**
					 * Javascript Events
					 * Htmls attributes
					 * UI Actions,Events
					 */
					'ui' => [
						'html' => [
							'filterInput' => [
								'placeholder' => 'Set Id'
							],
						],
						'events' => [],
					],
				],
				'title' => [
					'index' => 'title',
					'type' => 'string',
					'attributes' => [
						'label' => 'Title',
					],
					'enable' => true,
					'ui' => [
						'html' => [
							'filterInput' => [
								'placeholder' => 'Search Title'
							],
						],
					],
					'sort' => [
						'enable' => true,
					],
					'filter' => [
						'enable' => true,
					],
				],
				'description' => [
					'index' => 'description',
					'type' => 'textarea',
					'attributes' => [
						'label' => 'Description',
					],
					'enable' => false,
					'filter' => [
						'enable' => false,
					],
					'sort' => [
						'enable' => false,
					],
				],
				'status' => [
					'index' => 'status',
					'type' => 'string',
					'attributes' => [
						'label' => 'Status',
					],
					'enable' => true,
					'filter' => [
						'enable' => false,
					],
					'sort' => [
						'enable' => false,
					],
				],
			],
			'model' => [
				/**
				 * value to pass from page to page, default to model primary key
				 */
				'value' => [
					'index' => cd_config('database.surveys.questionSet.table.primary')
				],
				'class' => cd_config('database.surveys.questionSet.model.class'),
				'repository' => [
					/**
					 * Default sorting
					 */
					'sort' => ['position' => 'desc'],
					/**
					 * Records to view per page
					 */
					'rowsPerPage' => 20,
					'class' => cd_config('database.surveys.questionSet.repository.class')
				],
			],
		]
	],
];
