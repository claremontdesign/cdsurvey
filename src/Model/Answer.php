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
use Claremontdesign\Cdsurvey\Model\Contracts\AnswerInterface as ModelAnswerInterface;
use Claremontdesign\Cdbase\Form\Contracts\ElementInterface;

class Answer extends Model implements ActionModelInterface, WidgetModelInterface, FilterableInterface, JoinableInterface, SortableInterface, ModelAnswerInterface
{

	use Filterable,
	 SoftDeletes,
	 Joinable,
	 Sortable;

	/**
	 * The Form Element
	 * @var ElementInterface
	 */
	protected $element = null;

	/**
	 * Create a new Eloquent model instance.
	 *
	 * @param  array  $attributes
	 * @return void
	 */
	public function __construct(array $attributes = [])
	{
		$this->table = cd_config('database.surveys.answer.table.name');
		$this->primaryKey = cd_config('database.surveys.answer.table.primary');
		$this->fillable = cd_config('database.surveys.answer.model.fillable');
		$this->timestamps = false;
		parent::__construct($attributes);
	}

	// <editor-fold defaultstate="collapsed" desc="RELATIONSHIPS">
	/**
	 * Each answer can only have 1 question
	 */
	public function question()
	{
		return $this->belongsTo(cd_config('database.surveys.questions.model.class'));
	}

	/**
	 * Each answers can have multiple options
	 */
	public function options()
	{
		return $this->hasMany(cd_config('database.surveys.answerOptions.model.class'));
	}

	/**
	 * REturn the Options
	 * @param boolean $enabled Return all enabled only
	 * @return Collection
	 */
	public function getOptions($enabled = true)
	{
		return $this->options()->get();
	}

	// </editor-fold>

	public function id()
	{
		return $this->answer_id;
	}

	public function label()
	{
		return $this->label;
	}

	public function type()
	{
		return $this->answer_type;
	}

	public function description()
	{
		return $this->description;
	}

	public function position()
	{
		return $this->position;
	}

	/**
	 * Check if type has options
	 * @return boolean
	 */
	public function optionable()
	{
		$withOptions = ['checkbox', 'radio'];
		return in_array($this->type(), $withOptions);
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

	/**
	 * Set the Form Element
	 * @param \Claremontdesign\Cdbase\Form\Contracts\ElementInterface $element
	 */
	public function setElement(ElementInterface $element)
	{
		$this->element = $element;
	}

	/**
	 * Return the Element
	 * @return ElementInterface
	 */
	public function element()
	{
		return $this->element;
	}

}
