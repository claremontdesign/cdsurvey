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
		'surveysData' => [
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
			'exportable' => [
				'enable' => true,
				'attributes' => [
					'label' => 'Download/Export',
				],
				'format' => [
					'csv' => [
						'enable' => true,
						'attributes' => [
							'label' => 'Export to CSV',
						],
					]
				],
			],
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
			],
			'toolbars' => [
				'topleft' => [
					'create' => [
						'enable' => true,
						'attributes' => [
							'label' => 'New Survey',
						],
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => MODULE_SURVEYS,
								'action' => 'create',
							],
						],
					],
				],
			],
			/**
			 * Datatable CRUD Setup
			 */
			'action' => [
				'enable' => true,
				'route' => [
					/**
					 * Route will be generated using the module settings
					 * each ACTION is an action of a module.
					 * each ACTION can also pass its own route setup
					 */
					'name' => 'Module',
					'module' => MODULE_SURVEYS
				],
				'actions' => [
					'questions' => [
						'enable' => true,
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-questions',
								'action' => 'index'
							]
						],
					],
					'results' => [
						'enable' => true,
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-results',
								'action' => 'index',
								'record' => function(){
									return \Route::input('record');
								}
							]
						],
					],
					'start' => [
						'attributes' => [
							'label' => 'Take the Survey',
						],
						'enable' => true,
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys',
								'action' => 'customer'
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
						'enable' => false
					],
				],
			],
			/**
			 * Each is an instanceof /Widget/Datatable/ColumnInterface
			 * Columnnable, Attributable, Uitable, Htmlable
			 */
			'columns' => [
				'results' => [
					/**
					 * The name of DB tableColumn, if joint tables,
					 * 	include the DB column prefix
					 * default to columnIndex
					 */
					'index' => 'id',
					'enable' => false,
					'type' => 'string',
					'attributes' => [
						'label' => 'Result',
					],
				],
				'id' => [
					/**
					 * The name of DB tableColumn, if joint tables,
					 * 	include the DB column prefix
					 * default to columnIndex
					 */
					'position' => 0,
					'index' => cd_config('database.surveys.surveys.table.primary'),
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.surveys.table.name') . '.' . cd_config('database.surveys.surveys.table.primary')
					],
					'sort' => [
						'enable' => true,
						'index' => cd_config('database.surveys.surveys.table.name') . '.' . cd_config('database.surveys.surveys.table.primary')
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
								'placeholder' => 'Survey Id'
							],
						],
						'events' => [],
					],
				],
				'title' => [
					'position' => 1,
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
					'position' => 2,
					'index' => 'status',
					'type' => 'enabledisable',
					'attributes' => [
						'label' => 'Status',
					],
					'enable' => true,
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.surveys.table.name') . '.status'
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
				'startat' => [
					'index' => 'start_at',
					'type' => 'datetime',
					'enable' => false,
					'attributes' => [
						'label' => 'Date Started',
					],
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.surveys.table.name') . '.start_at'
					],
					'sort' => [
						'enable' => true,
					],
				],
				'endat' => [
					'index' => 'start_at',
					'type' => 'datetime',
					'enable' => false,
					'attributes' => [
						'label' => 'Date Ended',
					],
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.surveys.table.name') . '.end_at'
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
						'index' => cd_config('database.surveys.surveys.table.name') . '.created_at'
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
						'enable' => false,
					],
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.surveys.table.name') . '.created_at'
					],
				],
			],
			'model' => [
				/**
				 * value to pass from page to page, default to model primary key
				 */
				'value' => [
					'index' => cd_config('database.surveys.surveys.table.primary')
				],
				'class' => cd_config('database.surveys.surveys.model.class'),
				'repository' => [
					/**
					 * Default sorting
					 */
					'sort' => [cd_config('database.surveys.surveys.table.name') . '.position' => 'asc'],
					/**
					 * Records to view per page
					 */
					'rowsPerPage' => 20,
					'class' => cd_config('database.surveys.surveys.repository.class')
				],
			],
		]
	],
];
