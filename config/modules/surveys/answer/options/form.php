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
 * Each question can have multiple answers from a recipient
 * a recipient enters a number and write a message on the other input
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
		'surveysQuestionsAnswersOptionForm' => [
			'enable' => true,
			'type' => 'form',
			'access' => 'admin',
			'request' => [
				/**
				 * The Request Index
				 * the index of requests/inputs to check for recordId
				 */
				'index' => 'paramThree',
				/**
				 * Allow multiple forms/records to be manipulated
				 * @TODO, currently true
				 */
				'multiple' => true
			],
			'attributes' => [
				'recordName' => [
					'singular' => 'Question Answer',
					'plural' => 'Question Answers'
				],
			],
			'form' => [
				'messages' => [
					'empty' => 'No data found.',
					'notfound' => 'Cannot find the record/s you are looking for. Kindly try again.'
				],
				'ui' => [
					'html' => [
						'form' => []
					],
				],
				'fieldsets' => [
				],
				'tabs' => [
				],
				'actions' => [
					'submit' => [
						'type' => 'submit',
						'enable' => true,
						'ui' => [
							'html' => [
								'input' => []
							],
						],
						'attributes' => [
							'label' => 'Submit',
						],
					],
					'confirm' => [
						'enable' => false,
						'type' => 'confirm',
						'ui' => [
							'html' => [
								'input' => []
							],
						],
						'attributes' => [
							'label' => 'Confirm',
						],
					],
					'cancel' => [
						'enable' => true,
						'type' => 'cancel',
						'ui' => [
							'tag' => 'a',
							'url' => [
								'route' => [
									'name' => 'Module',
									'module' => 'surveys-questions-answers-options',
									'record' => function(){
								return \Route::input('record');
									},
									'paramOne' => function(){
								return \Route::input('paramOne');
									},
									'paramTwo' => function(){
								return \Route::input('paramTwo');
									},
								]
							],
							'html' => [
								'input' => []
							],
						],
						'attributes' => [
							'label' => 'Cancel',
						],
					],
				],
				'elements' => [
					'label' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'option_name',
							],
						],
						'type' => 'text',
						'position' => 2,
						'attributes' => [
							'label' => 'Label',
							'placeholder' => 'Label'
						],
					],
					'value' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'option_value',
							],
						],
						'type' => 'text',
						'position' => 2,
						'attributes' => [
							'label' => 'Value',
							'placeholder' => 'Value'
						],
					],
					'status' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'status',
							],
						],
						'type' => 'select',
						'select' => [
							'options' => [
								'options' => 'enabledisable'
							]
						],
						'position' => 1,
						'attributes' => [
							'label' => 'Status',
						],
					],
					'position' => [
						'enable' => true,
						'model' => [
							'value' => [
								'index' => 'position',
							],
						],
						'type' => 'number',
						'position' => 1,
						'attributes' => [
							'label' => 'Position',
						],
					],
				],
			],
			'model' => [
				'value' => [
					/**
					 * The property/method of the model
					 * 	to use extract the value that will be passed from page to page
					 * @see WidgetType\Form::valueIndex()
					 */
					'index' => cd_config('database.surveys.answerOptions.table.primary')
				],
				'class' => cd_config('database.surveys.answerOptions.model.class'),
				'repository' => [
					'class' => cd_config('database.surveys.answerOptions.repository.class'),
					'index' => cd_config('database.surveys.answerOptions.table.name') . '.' . cd_config('database.surveys.answerOptions.table.primary'),
				],
				'crud' => [
					'duplicate' => [
						'enable' => false],
					'create' => [
						'enable' => true,
						'type' => 'create',
						'crud' => [
							'type' => 'crud',
							'enable' => true,
						],
						'success' => [
							/**
							 * Redirec to route
							 */
							'redirect' => [
								'enable' => true,
								'route' => [
									'name' => 'Module',
									'module' => 'surveys-questions-answers-options',
									'record' => function(){
								return \Route::input('record');
									},
									'paramOne' => function(){
								return \Route::input('paramOne');
									},
									'paramTwo' => function(){
								return \Route::input('paramTwo');
									},
								]
							],
							'back' => [],
							'message' => 'Created successfull!'
						],
					],
					'update' => [
						'enable' => true,
						'type' => 'update',
						'success' => [
							'route' => [],
							'message' => 'Update successfull!'
						],
						'crud' => [
							'type' => 'crud',
							'enable' => true,
							'ui' => [
								'tag' => 'a',
								'url' => [
									'route' => [
										'name' => 'Module',
										'module' => 'surveys-questions-answers-options',
										'action' => 'update',
										'record' => function(){
									return \Route::input('record');
									},
										'paramOne' => function(){
									return \Route::input('paramOne');
									},
										'paramTwo' => function(){
									return \Route::input('paramTwo');
									},
									]
								],
								'html' => [
									'input' => []
								],
							],
							'attributes' => [
								'label' => 'Update',
							],
						],
					],
					'view' => [
						'enable' => true,
						'type' => 'view',
						/**
						 * @see WidgetType\Form::_actions()
						 */
						'crud' => [
							'type' => 'crud',
							'enable' => true,
						],
						'actions' => ['update', 'delete']
					],
					'delete' => [
						'enable' => true,
						'type' => 'delete',
						/**
						 * Crud settings
						 * When a record is viewed (@see crud.view),
						 * action anchors can be displayed as actions for that record.
						 * if this crud is in the list of actions (@see crud.view.actions),
						 * this will be the settings that will be used
						 * This settings is also used to check role for data access
						 * @see Widget\ModelInterface
						 * @see WidgetType\Form::_actions()
						 */
						'crud' => [
							'type' => 'crud',
							'enable' => true,
							'ui' => [
								'tag' => 'a',
								'url' => [
									'route' => [
										'name' => 'Module',
										'module' => 'surveys-questions-answers-options',
										'action' => 'delete',
										'record' => function(){
									return \Route::input('record');
									},
										'paramOne' => function(){
									return \Route::input('paramOne');
									},
										'paramTwo' => function(){
									return \Route::input('paramTwo');
									},
									]
								],
								'html' => [
									'input' => []
								],
							],
							'attributes' => [
								'label' => 'Delete',
							],
						],
						'view' => [
							/**
							 * Template to use to load this form
							 * when CrudAction == delete
							 * @see WidgetType\Form::getForm()
							 */
							'form' => [
								'enable' => false,
								'path' => 'form.index',
								/**
								 * render template before form tag
								 */
								'pre' => [],
								/**
								 * render template after form tag
								 */
								'post' => [],
							],
						],
						/**
						 * After success action configuration
						 */
						'success' => [
							'redirect' => [
								'enable' => true,
								'route' => [
									'name' => 'Module',
									'module' => 'surveys-questions-answers-options',
									'record' => function(){
								return \Route::input('record');
									},
									'paramOne' => function(){
								return \Route::input('paramOne');
									},
									'paramTwo' => function(){
								return \Route::input('paramTwo');
									},
								]
							],
							'message' => 'Delete successfull!'
						],
					],
				],
			],
		],
	],
];
