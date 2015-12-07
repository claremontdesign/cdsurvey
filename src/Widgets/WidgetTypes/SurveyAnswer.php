<?php

namespace Claremontdesign\Cdsurvey\Widgets\WidgetTypes;

/**
 * Dx
 *
 * @link http://dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2015 ClaremontDesign/MadLabs-Dx
 * @version 0.0.0.1
 * @since Nov 10, 2015 3:06:19 PM
 * @file Datatable.php
 * @project Cdbase
 */
class SurveyAnswer extends Survey
{

	/**
	 * Check if this has lready a customer
	 * @return boolean
	 */
	public function hasCustomer()
	{
		return true;
	}

	/**
	 * Return the Customer
	 * @return ModelCustomer
	 */
	public function getCustomer()
	{
		return $this->getResult()->customer();
	}

	/**
	 * Return questions per page
	 * @return integer
	 */
	public function getQuestionsPerPage()
	{
		return 999999999;
	}

	/**
	 * Return the Survey View
	 */
	public function getWidget()
	{
		$defaultView = $this->getViewName('widgets.survey.answer');
		$view = $this->getConfig('view.answer', $defaultView);
		return $this->view($view, $defaultView, array('widget' => $this));
	}

}
