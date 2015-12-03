<?php

namespace Claremontdesign\Cdsurvey\Http\Controllers;

/**
 * Dx
 *
 * @link http://dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2015 ClaremontDesign/MadLabs-Dx
 * @version 0.0.0.1
 * @since Dec 1, 2015 12:25:35 PM
 * @file SurveyController.php
 * @project Cdbase
 * @package Cdsurvey
 */
use Claremontdesign\Cdbase\Http\Controllers\Controller as BaseController;
use Claremontdesign\Cdbase\Traits\Flasherror;

class SurveyController extends BaseController
{

	use Flasherror;

	public function index()
	{
		return view(cd_survey_view_name('index/index'), compact('surveyId'));
	}

	public function postIndex()
	{
		$surveyId = app('request')->input('survey')[0];
		$widget = cd_widget_standalone('survey', compact('surveyId'), null, $this);
		if($widget instanceof \Illuminate\Http\RedirectResponse)
		{
			return $widget;
		}
		return view(cd_survey_view_name('index/index'), compact('surveyId'));
	}

}
