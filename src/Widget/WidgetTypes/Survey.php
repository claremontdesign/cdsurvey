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

use Claremontdesign\Cdsurvey\Widgets\WidgetTypes\Widget;
use Claremontdesign\Cdbase\Traits\Repository;

class Survey extends Widget
{

	use Repository;

	/**
	 * Widget Type
	 * @var string
	 */
	protected $type = 'survey';

	/**
	 * Widget Configuration
	 * @var type
	 */
	protected $config = null;

	/**
	 * The Widget Parent
	 * @var Claremontdesign\Cdbase\Widgets
	 */
	protected $widget = null;

	/**
	 * Collection of Repositories
	 * @var Collection
	 */
	protected $repos = [];


	/**
	 * Widget Constructo
	 * @param string $widget The Widget Object
	 * @param Collection $config The Widget Configuration Collection
	 */
	public function __construct($widget, $config)
	{
		$this->collect($this->repos);
		$this->config = $config;
		$this->widget = $widget;
		return $this;
	}

	// <editor-fold defaultstate="collapsed" desc="DATA">
	public function getRepo($repoIndex)
	{
		$repo = $this->repos->get($repoIndex);
	}

	/**
	 * Return the Rows
	 * @return LengthAwarePaginator
	 */
	public function getQuestions()
	{
		if($this->data === false)
		{
			$columns = ['*'];
			$filters = [];
			$joins = [];
			$sort = [];
			$paginate = !empty($this->config['questions']['perpage']) ? $this->config['question']['perpage'] : 1;
			$options = [];
			$this->data = $this->getRepository()->getAll($columns, $filters, $sort, $joins, $paginate, $options, false);
			if(empty($this->data->count()))
			{
				if(!empty($filters))
				{
					$this->emptyMessage(null, 'notfound');
				}
				else
				{
					$this->emptyMessage();
				}
			}
		}
		return $this->data;
	}

	// </editor-fold>

	/**
	 * Return the Survey View
	 */
	public function getSurvey()
	{
		$defaultView = cd_widget_default_view('survey.survey');
		$view = !empty($this->config['view']) && !empty($this->config['view']['survey']) ? $this->config['view']['survey'] : $defaultView;
		return $this->view($view, $defaultView, array('widget' => $this));
	}

	/**
	 * Prepare the widget
	 */
	public function prepare()
	{
		if(!$this->prepared)
		{

		}
		$this->prepared = true;
	}

	/**
	 * Render the content
	 * @return string|html|null
	 */
	public function render()
	{
		$this->prepare();
		return $this->getSurvey();
	}

}
