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
		'surveysQuestionsData' => [
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
					'empty' => 'No Questions found.',
					'notfound' => 'Cannot find the question you are looking for. Kindly try again.'
				],
			],
			'config' => [
				'attributes' => [
					'recordName' => [
						'singular' => 'Survey Questions',
						'plural' => 'Surveys Questions'
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
							'label' => 'New Question',
						],
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-questions',
								'action' => 'create',
								'record' => function(){
							return \Route::input('record');
								}
							],
						],
					],
					'questionSet' => [
						'enable' => false,
						'attributes' => [
							'label' => 'Question Set',
						],
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-questions-set',
								'action' => 'index',
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
					'module' => 'surveys-questions'
				],
				'actions' => [
					'answers' => [
						'enable' => true,
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-questions-answers',
								'action' => 'index'
							]
						],
					],
					'update' => [
						'enable' => true,
					],
					'delete' => [
						'enable' => true,
					],
					'view' => [
						'enable' => false,
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
					'index' => cd_config('database.surveys.questions.table.primary'),
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.questions.table.name') . '.' . cd_config('database.surveys.questions.table.primary')
					],
					'sort' => [
						'enable' => true,
						'index' => cd_config('database.surveys.questions.table.name') . '.' . cd_config('database.surveys.questions.table.primary')
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
								'placeholder' => 'ID'
							],
						],
						'events' => [],
					],
				],
				'status' => [
					'index' => 'status',
					'type' => 'enabledisable',
					'attributes' => [
						'label' => 'Status',
					],
					'enable' => true,
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.questions.table.name') . '.status'
					],
					'ui' => [
						'html' => [
							'filterInput' => [
								'placeholder' => 'Search Status'
							],
						],
					],
					'sort' => [
						'enable' => true,
					],
				],
				'question' => [
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
				'type' => [
					'index' => 'type',
					'type' => 'string',
					'attributes' => [
						'label' => 'Type',
					],
					'enable' => false,
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.questions.table.name') . '.type'
					],
					'ui' => [
						'html' => [
							'filterInput' => [
								'placeholder' => 'Search Type'
							],
						],
					],
					'sort' => [
						'enable' => true,
					],
				],
				'created' => [
					'index' => 'created_at',
					'type' => 'datetime',
					'enable' => false,
					'attributes' => [
						'label' => 'Date Created',
					],
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.questions.table.name') . '.created_at'
					],
					'sort' => [
						'enable' => true,
					],
				],
				'updated' => [
					'enable' => false,
					'type' => 'datetime',
					'index' => 'updated_at',
					'attributes' => [
						'label' => 'Last Update',
					],
					'sort' => [
						'enable' => true,
					],
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.questions.table.name') . '.created_at'
					],
				],
			],
			'model' => [
				/**
				 * value to pass from page to page, default to model primary key
				 */
				'value' => [
					'index' => cd_config('database.surveys.questions.table.primary')
				],
				'class' => cd_config('database.surveys.questions.model.class'),
				'repository' => [
					/**
					 * Default sorting
					 */
					'sort' => ['position' => 'desc'],
					/**
					 * Records to view per page
					 */
					'rowsPerPage' => 20,
					'class' => cd_config('database.surveys.questions.repository.class')
				],
			],
		]
	],
];
