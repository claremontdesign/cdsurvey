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
use Claremontdesign\Cdsurvey\Model\Contracts\QuestionInterface as ModelQuestionInterface;

class Question extends Model implements WidgetModelInterface, FilterableInterface, JoinableInterface, SortableInterface, ModelQuestionInterface
{

	use Filterable,
	 SoftDeletes,
	 Joinable,
	 Sortable;

	/**
	 * Prepared Answers
	 */
	protected $preparedAnswers = [];

	/**
	 * Create a new Eloquent model instance.
	 *
	 * @param  array  $attributes
	 * @return void
	 */
	public function __construct(array $attributes = [])
	{
		$this->table = cd_config('database.surveys.questions.table.name');
		$this->primaryKey = cd_config('database.surveys.questions.table.primary');
		$this->fillable = cd_config('database.surveys.questions.model.fillable');
		$this->preparedAnswers = collect($this->preparedAnswers);
		parent::__construct($attributes);
	}

	/**
	 * Each question has one survey
	 */
	public function survey()
	{
		return $this->belongsTo(cd_config('database.surveys.surveys.model.class'));
	}

	public function results()
	{
		return $this->hasMany(cd_config('database.surveys.result.model.class'));
	}

	/**
	 * REturn the Survey object
	 * @return type
	 */
	public function getSurvey()
	{
		return $this->survey()->get();
	}

	/**
	 * Each questions can have multiple answers
	 */
	public function answers()
	{
		return $this->hasMany(cd_config('database.surveys.answer.model.class'));
	}

	/**
	 *
	 * @return Collection
	 */
	public function getAnswers()
	{
		return $this->answers()->where('status', 1)->sort('position', 'DESC')->get();
	}

	/**
	 * Return PreparedAnswers
	 * @return Collection
	 */
	public function preparedAnswers()
	{
		return $this->preparedAnswers;
	}

	public function id()
	{
		return $this->question_id;
	}

	/**
	 * Return the title
	 */
	public function title()
	{
		return $this->question();
	}

	/**
	 * The Question
	 */
	public function question()
	{
		return $this->title;
	}

	/**
	 * Check if this has a note
	 * @return boolean
	 */
	public function hasNote()
	{
		return !empty($this->description);
	}

	public function note()
	{
		return $this->description;
	}

	public function position()
	{
		return $this->position;
	}


	// <editor-fold defaultstate="collapsed" desc="WIDGET">
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

	/**
	 * Fix array values to column values
	 * 	Map the given values to column values
	 * @param  array $assocArray [description]
	 * @return array
	 */
	public function fixValueToColumnValue($assocArray)
	{
		return parent::fixValueToColumnValue($assocArray);
	}

}
