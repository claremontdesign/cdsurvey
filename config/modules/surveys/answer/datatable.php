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
		'surveysQuestionsAnswersTypeData' => [
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
					'empty' => 'No Answer setup found for this question.',
					'notfound' => 'Cannot find the question you are looking for. Kindly try again.'
				],
			],
			'config' => [
				'attributes' => [
					'recordName' => [
						'singular' => 'Question Answer Type',
						'plural' => 'Question Answer Types'
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
				'index' => 'paramTwo',
			],
			'toolbars' => [
				'topleft' => [
					'create' => [
						'enable' => true,
						'attributes' => [
							'label' => 'New Answer',
						],
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-questions-answers',
								'action' => 'create',
								'record' => function(){
							return \Route::input('record');
									},
								'paramOne' => function(){
							return \Route::input('paramOne');
									},
							],
						],
					],
				],
			],
			'action' => [
				'enable' => true,
				'route' => [
					'name' => 'Module',
					'module' => 'surveys-questions-answers',
				],
				'actions' => [
					'options' => [
						'enable' => true,
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-questions-answers-options',
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
					'index' => cd_config('database.surveys.answer.table.primary'),
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveys.answer.table.name') . '.' . cd_config('database.surveys.answer.table.primary')
					],
					'sort' => [
						'enable' => true,
						'index' => cd_config('database.surveys.answer.table.name') . '.' . cd_config('database.surveys.answer.table.primary')
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
								'placeholder' => 'Answer Type Id'
							],
						],
						'events' => [],
					],
				],
				'label' => [
					'index' => 'label',
					'type' => 'text',
					'attributes' => [
						'label' => 'Label',
					],
					'enable' => true,
					'filter' => [
						'enable' => false,
					],
					'sort' => [
						'enable' => false,
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
					'index' => 'answer_type',
					'value' => [
						'callbacks' => 'ucfirst|strtolower'
					],
					'type' => 'string',
					'attributes' => [
						'label' => 'Type',
					],
					'enable' => true
				],
				'status' => [
					'index' => 'status',
					'type' => 'enabledisable',
					'attributes' => [
						'label' => 'Status',
					],
					'enable' => true,
					'filter' => [
						'enable' => false,
					],
					'sort' => [
						'enable' => true,
					],
				],
				'required' => [
					'index' => 'required',
					'type' => 'yesno',
					'attributes' => [
						'label' => 'Is Required?',
					],
					'enable' => true,
					'filter' => [
						'enable' => false,
					],
					'sort' => [
						'enable' => true,
					],
				],
				'position' => [
					'index' => 'position',
					'type' => 'string',
					'attributes' => [
						'label' => 'Position',
					],
					'enable' => false,
					'filter' => [
						'enable' => false,
					],
					'sort' => [
						'enable' => true,
					],
				],
			],
			'model' => [
				/**
				 * value to pass from page to page, default to model primary key
				 */
				'value' => [
					'index' => cd_config('database.surveys.answer.table.primary')
				],
				'class' => cd_config('database.surveys.answer.model.class'),
				'repository' => [
					/**
					 * Default sorting
					 */
					'sort' => ['position' => 'desc'],
					/**
					 * Records to view per page
					 */
					'rowsPerPage' => 20,
					'class' => cd_config('database.surveys.answer.repository.class')
				],
			],
		]
	],
];
