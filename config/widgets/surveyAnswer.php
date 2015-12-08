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
 * @project Cdsurvey
 */
return [
	'widgets' => [
		'surveyAnswer' => [
			'configMerge' => 'widgets.surveyAvailable',
			'enable' => true,
			'type' => 'surveyAnswer',
			'toolbars' => [
				'topright' => [
					'print' => [
						'attributes' => [
							'label' => 'Print View',
						],
						'ui' => [
							'html' => [
								'a' => [
									'target' => '_blank',
								]
							],
						],
						'enable' => true,
						'url' => [
							'route' => [
								'static' => true,
								'name' => 'Module',
								'module' => 'surveys-results-answers',
								'action' => 'print',
								'record' => function(){ return app('cdbackend')->routeParam('record');},
								'paramOne' => function(){ return app('cdbackend')->routeParam('paramOne');}
							]
						],
					],
				],
			],
		],
	],
];
