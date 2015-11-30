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
interface QuestionInterface
{

	/**
	 * The Survey
	 */
	public function survey();

	public function getSurvey();

	/**
	 * Each question has answers
	 */
	public function answers();

	public function getAnswers();

	/**
	 * The ID
	 */
	public function id();

	/**
	 * Question
	 */
	public function question();

	/**
	 * Note
	 */
	public function note();
}
