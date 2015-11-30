<?php

namespace Claremontdesign\Cdsurvey\Model\Contracts;

/**
 * Dx
 *
 * @link http://dennesabing.com
 * @author Dennes B Abing <dennes.b.abing@gmail.com>
 * @license proprietary
 * @copyright Copyright (c) 2015 ClaremontDesign/MadLabs-Dx
 * @version 0.0.0.1
 * @since Nov 30, 2015 5:16:52 PM
 * @file SurveyInterface.php
 * @project Cdbase
 * @package Cdsurvey
 */
interface AnswerInterface
{

	/**
	 * The Survey
	 */
	public function question();

	/**
	 * Each answer has multiple options to be selected
	 */
	public function options();

	/**
	 * The ID
	 */
	public function id();

	/**
	 * Question Title
	 */
	public function title();
}
