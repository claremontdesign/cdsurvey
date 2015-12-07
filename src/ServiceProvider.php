<?php

namespace Claremontdesign\Cdsurvey;

/**
 * Dx
 *
 * @link http://dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2015 ClaremontDesign/MadLabs-Dx
 * @version 0.0.0.1
 * @since Nov 27, 2015 1:43:45 PM
 * @file routes.php
 * @project Claremontdesign
 * @package Cdsurvey
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

	public function register()
	{
		// Register this service
		$this->app->singleton('cdsurvey', function($app){
			return new Cdsurvey;
		});
		app('cdbase')->addPackage(\Claremontdesign\Cdsurvey\Cdsurvey::class);
		app('cdbase')->addModule('surveys', __DIR__ . '/../config/modules/surveys/surveys.php');
		app('cdbase')->addCommand('migrate', 'db:seed --class=SurveyTableSeeder');
	}

	public function boot()
	{
		// Define the path for the view files
		$this->loadViewsFrom(__DIR__ . '/../resources/views', cd_survey_tag());

		$this->publishes([
			__DIR__ . '/../resources/assets' => public_path('assets/claremontdesign/cdsurvey'),
				], 'public');

		$this->publishes([
			__DIR__ . '/../resources/views' => base_path('resources/views/claremontdesign/cdsurvey'),
				], 'views');

		$this->publishes([
			__DIR__ . '/../database' => base_path('database')
				], 'migrations');


		// Loading the routes file
		require __DIR__ . '/Http/routes.php';
	}

}
