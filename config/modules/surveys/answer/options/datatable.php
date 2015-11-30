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
	'widgets' => [
		'surveysQuestionsAnswersOptionData' => [
			'access' => 'admin',
			'enable' => true,
			'type' => 'datatable',
			'messages' => [
				'empty' => [
					'empty' => 'No options found for this answer.',
					'notfound' => 'No options found. Kindly try again.'
				],
			],
			'config' => [
				'attributes' => [
					'recordName' => [
						'singular' => 'Answer Option',
						'plural' => 'Answer Options'
					],
				],
			],
			'request' => [
				'index' => 'paramThree',
			],
			'toolbars' => [
				'topleft' => [
					'create' => [
						'enable' => true,
						'attributes' => [
							'label' => 'New Option',
						],
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-questions-answers-options',
								'action' => 'create',
								'record' => function(){
							return \Route::input('record');
									},
								'paramOne' => function(){
							return \Route::input('paramOne');
									},
								'paramTwo' => function(){
							return \Route::input('paramTwo');
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
					'module' => 'surveys-questions-answers-options',
				],
				'actions' => [
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
					'index' => cd_config('database.surveysQuestionsAnswerOptions.table.primary'),
					'filter' => [
						'enable' => true,
						'index' => cd_config('database.surveysQuestionsAnswerOptions.table.name') . '.' . cd_config('database.surveysQuestionsAnswerOptions.table.primary')
					],
					'sort' => [
						'enable' => true,
						'index' => cd_config('database.surveysQuestionsAnswerOptions.table.name') . '.' . cd_config('database.surveysQuestionsAnswerOptions.table.primary')
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
								'placeholder' => 'Option Id'
							],
						],
						'events' => [],
					],
				],
				'label' => [
					'index' => 'option_name',
					'type' => 'text',
					'attributes' => [
						'label' => 'Label',
					],
					'enable' => true,
					'filter' => [
						'enable' => true,
					],
					'sort' => [
						'enable' => true,
					],
				],
				'value' => [
					'index' => 'option_value',
					'type' => 'text',
					'attributes' => [
						'label' => 'Value',
					],
					'enable' => true,
					'filter' => [
						'enable' => true,
					],
					'sort' => [
						'enable' => true,
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
						'enable' => true,
					],
				],
				'position' => [
					'index' => 'position',
					'type' => 'string',
					'attributes' => [
						'label' => 'Position',
					],
					'enable' => true,
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
					'index' => cd_config('database.surveysQuestionsAnswerOptions.table.primary')
				],
				'class' => cd_config('database.surveysQuestionsAnswerOptions.model.class'),
				'repository' => [
					/**
					 * Default sorting
					 */
					'sort' => ['position' => 'desc'],
					/**
					 * Records to view per page
					 */
					'rowsPerPage' => 20,
					'class' => cd_config('database.surveysQuestionsAnswerOptions.repository.class')
				],
			],
		]
	],
];
