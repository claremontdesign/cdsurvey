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
use Claremontdesign\Cdsurvey\Model\Contracts\SurveyInterface as ModelSurveyInterface;

class Survey extends Model implements WidgetModelInterface, FilterableInterface, JoinableInterface, SortableInterface, ModelSurveyInterface
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
		$this->table = cd_config('database.surveys.surveys.table.name');
		$this->primaryKey = cd_config('database.surveys.surveys.table.primary');
		$this->fillable = cd_config('database.surveys.surveys.model.fillable');
		parent::__construct($attributes);
	}

	/**
	 * Each survey has many questions
	 */
	public function questions()
	{
		return $this->hasMany(cd_config('database.surveys.questions.model.class'));
	}

	public function results()
	{
		return $this->hasMany(cd_config('database.surveys.result.model.class'));
	}

	public function id()
	{
		return $this->survey_id;
	}

	/**
	 * Survey Title
	 * @return type
	 */
	public function title()
	{
		return $this->title;
	}

	/**
	 * Survey Title
	 * @return type
	 */
	public function description()
	{
		return $this->description;
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
	public function fixValueToColumnValue($assocArray, $mode = null)
	{
		if(empty($assocArray['start_at']))
		{
			$assocArray['start_at'] = date('Y-m-d');
		}
		return parent::fixValueToColumnValue($assocArray);
	}

}
