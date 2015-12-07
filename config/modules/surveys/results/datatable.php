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
		'surveysResultsData' => [
			'access' => 'admin',
			'enable' => true,
			'type' => 'datatable',
			'messages' => [
				'empty' => [
					'empty' => 'No Results found.',
					'notfound' => 'Cannot find the results you are looking for. Kindly try again.'
				],
			],
			'config' => [
				'attributes' => [
					'recordName' => [
						'singular' => 'Survey Result',
						'plural' => 'Surveys Results'
					],
				],
			],
			'request' => [
				'index' => 'paramOne',
			],
			'action' => [
				'enable' => true,
				'route' => [
					'name' => 'Module',
					'module' => 'surveys-results'
				],
				'actions' => [
					'view' => [
						'attributes' => [
							'label' => 'View Result',
						],
						'enable' => true,
						'url' => [
							'route' => [
								'name' => 'Module',
								'module' => 'surveys-results-answers',
								'action' => 'index'
							]
						],
					],
				],
			],
			'columns' => [
				'id' => [
					'enable' => true,
					'index' => cd_config('database.surveys.result.table.primary'),
					'filter' => [
						'enable' => false,
						'index' => cd_config('database.surveys.result.table.name') . '.' . cd_config('database.surveys.result.table.primary')
					],
					'sort' => [
						'enable' => true,
						'index' => cd_config('database.surveys.result.table.name') . '.' . cd_config('database.surveys.result.table.primary')
					],
					'type' => 'integer',
					'attributes' => [
						'label' => 'ID',
					],
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
						'enable' => false,
						'index' => cd_config('database.surveys.result.table.name') . '.status'
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
				'isnew' => [
					'index' => 'is_new',
					'type' => 'yesno',
					'attributes' => [
						'label' => 'New?',
					],
					'enable' => false,
					'filter' => [
						'enable' => false,
						'index' => cd_config('database.surveys.result.table.name') . '.is_new'
					],
					'sort' => [
						'enable' => true,
					],
				],
				'ipaddress' => [
					'index' => 'ip_address',
					'type' => 'string',
					'attributes' => [
						'label' => 'IP Address',
					],
					'enable' => true,
					'ui' => [
						'html' => [
							'filterInput' => [
								'placeholder' => 'IP Address'
							],
						],
					],
					'sort' => [
						'enable' => true,
					],
					'filter' => [
						'enable' => false,
					],
				],
				'customer' => [
					'index' => 'customer_id',
					'type' => 'textarea',
					'attributes' => [
						'label' => 'Customer',
					],
					'enable' => false,
					'filter' => [
						'enable' => false,
					],
					'sort' => [
						'enable' => false,
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
						'index' => cd_config('database.surveys.result.table.name') . '.created_at'
					],
					'sort' => [
						'enable' => true,
					],
				],
			],
			'model' => [
				'value' => [
					'index' => cd_config('database.surveys.result.table.primary')
				],
				'class' => cd_config('database.surveys.result.model.class'),
				'repository' => [
					'sort' => ['is_new' => 'desc'],
					'rowsPerPage' => 20,
					'class' => cd_config('database.surveys.result.repository.class')
				],
			],
		]
	],
];
