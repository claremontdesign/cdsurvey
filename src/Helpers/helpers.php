<?php

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
if(!function_exists('cd_survey'))
{

	function cd_survey()
	{
		return app('cdsurvey');
	}

}
if(!function_exists('cd_survey_tag'))
{

	/**
	 * Return this packge tag
	 * @return string
	 */
	function cd_survey_tag()
	{
		return 'cdsurvey';
	}

}
if(!function_exists('cd_survey_view_name'))
{

	/**
	 * Return this package view name
	 * view(cd_survey_view_name('view-name')) = nhr::view-name
	 * @param string $view The View Name
	 * @return string
	 */
	function cd_survey_view_name($view)
	{
		return cd_survey_tag() . '::' . $view;
	}

}

