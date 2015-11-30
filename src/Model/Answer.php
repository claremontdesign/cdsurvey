<?php

namespace Claremontdesign\Cdsurvey\Model;

/**
 * Survey has set of questions
 * 	Create a survey.
 * 		Create Sets of Questions
 * 		Create Questions for each sets
 *
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
use Claremontdesign\Cdbase\Repository\Contracts\FilterableInterface;
use Claremontdesign\Cdbase\Repository\Contracts\JoinableInterface;
use Claremontdesign\Cdbase\Repository\Contracts\SortableInterface;
use Claremontdesign\Cdbase\Repository\Traits\Filterable;
use Claremontdesign\Cdbase\Repository\Traits\Joinable;
use Claremontdesign\Cdbase\Repository\Traits\Sortable;
use Claremontdesign\Cdbase\Model\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Claremontdesign\Cdbase\Widgets\ModelInterface as WidgetModelInterface;
use Claremontdesign\Cdbase\Widgets\WidgetTypes\WidgetTypeInterface;
use Claremontdesign\Cdbase\Widgets\WidgetTypes\ActionModelInterface;

class Answer extends Model implements ActionModelInterface, WidgetModelInterface, FilterableInterface, JoinableInterface, SortableInterface
{

	use Filterable,
	 SoftDeletes,
	 Joinable,
	 Sortable;

	/**
	 * Create a new Eloquent model instance.
	 *
	 * @param  array  $attributes
	 * @return void
	 */
	public function __construct(array $attributes = [])
	{
		$this->table = cd_config('database.surveysQuestionsAnswer.table.name');
		$this->primaryKey = cd_config('database.surveysQuestionsAnswer.table.primary');
		$this->fillable = cd_config('database.surveysQuestionsAnswer.model.fillable');
		$this->timestamps = false;
		parent::__construct($attributes);
	}

	// <editor-fold defaultstate="collapsed" desc="RELATIONSHIPS">
	/**
	 * Each answer can only have 1 question
	 */
	public function question()
	{
		return $this->belongsTo(cd_config('database.surveysQuestions.model.class'));
	}

	/**
	 * Each answers can have multiple options
	 */
	public function options()
	{
		return $this->hasMany(cd_config('database.surveysQuestionsAnswerOptions.model.class'));
	}

	// </editor-fold>

	public function id()
	{
		return $this->answer_id;
	}

	/**
	 * Check if type has options
	 * @return boolean
	 */
	public function optionable()
	{
		$withOptions = ['checkbox', 'dropdownselect', 'radioselect', 'multipleselect'];
		return in_array($this->answer_type, $withOptions);
	}

	// <editor-fold defaultstate="collapsed" desc="WIDGET">

	/**
	 * Check widget access
	 * @return boolean
	 */
	public function checkWidgetAction($widget, $crud, $access = null)
	{
		if($crud == 'options')
		{
			return $this->optionable();
		}
		return true;
	}

	/**
	 * Check widget access
	 * @return boolean
	 */
	public function checkWidgetAccess(WidgetTypeInterface $widget, $crud, $access = null)
	{
		return true;
	}

	/**
	 *
	 * @param \Claremontdesign\Cdbase\Widgets\WidgetTypes\WidgetTypeInterface $widget
	 * @param type $crud
	 * @param type $data
	 */
	public function widgetPreProcess(WidgetTypeInterface $widget, $crud, $modelId, $data)
	{

	}

	/**
	 *
	 * @param \Claremontdesign\Cdbase\Widgets\WidgetTypes\WidgetTypeInterface $widget
	 * @param type $crud
	 * @param type $data
	 */
	public function widgetPostProcess(WidgetTypeInterface $widget, $crud, $modelId, $data, $result)
	{

	}

	// </editor-fold>

	public function setUpdatedAt($value)
	{

	}

	public function setCreatedAt($value)
	{

	}

	/**
	 * Fix array values to column values
	 * 	Map the given values to column values
	 * @param  array $assocArray [description]
	 * @return array
	 */
	public function fixValueToColumnValue($assocArray)
	{
		if(!empty($assocArray['survey_id']))
		{
			unset($assocArray['survey_id']);
		}
		return parent::fixValueToColumnValue($assocArray);
	}

}
