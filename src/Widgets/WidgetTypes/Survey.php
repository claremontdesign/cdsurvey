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
use Claremontdesign\Cdbase\Widgets\WidgetTypes\Widget;
use Claremontdesign\Cdbase\Traits\Repository;
use Claremontdesign\Cdsurvey\Model\Contracts\SurveyInterface as ModelSurveyInterface;
use Claremontdesign\Cdsurvey\Model\Contracts\AnswerInterface as ModelAnswerInterface;

class Survey extends Widget
{

	use Repository;

	/**
	 * Widget Type
	 * @var string
	 */
	protected $type = 'survey';

	/**
	 * Prepare Widget
	 * @var boolean
	 */
	protected $prepared = false;

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
	 * Collections of Questions
	 * @var Collection
	 */
	protected $questions = false;

	/**
	 * Question Sets
	 * @var Collection
	 */
	protected $questionSets = false;

	/**
	 * The Survey Objecty
	 * @var ModelSurvey
	 */
	protected $survey = false;

	/**
	 * Form Widget
	 * @var WidgetType
	 */
	protected $form = null;

	/**
	 * Widget Constructo
	 * @param string $widget The Widget Object
	 * @param Collection $config The Widget Configuration Collection
	 */
	public function __construct($widget, $config)
	{
		$this->repos = $this->collect($this->repos);
		$this->config = $config;
		$this->widget = $widget;
		return $this;
	}

	/**
	 * Retur the Survey Id
	 * @return type
	 */
	public function getSurveyId()
	{
		return $this->widget()->getParameter('survey_id');
	}

	/**
	 * Use Set
	 * @return boolean
	 */
	public function useSet()
	{
		return $this->getConfig('questions.set', false);
	}

	// <editor-fold defaultstate="collapsed" desc="DATA">
	/**
	 * Repo a Repository
	 * @param type $repoIndex
	 * @return type
	 * @throws \Exception
	 */
	public function getRepo($repoIndex)
	{
		$repo = $this->repos->get($repoIndex);
		if(is_null($repo))
		{
			$repoConfig = $this->getConfig('models.' . $repoIndex);
			if(!is_null($repoConfig))
			{
				$this->repos->put($repoIndex, $this->createModelRepo($this->getConfig('models.' . $repoIndex)));
				return $this->repos->get($repoIndex);
			}
			else
			{
				throw new \Exception('Survey repository index "' . $repoIndex . '" not found.');
			}
		}
		return $repo;
	}

	/**
	 * Check this hasQuestions
	 * @return boolean
	 */
	public function hasSurvey()
	{
		$survey = $this->getSurvey();
		$questions = $this->getQuestions();
		return $survey instanceof ModelSurveyInterface && !$questions->isEmpty();
	}

	/**
	 * Return the Survey Object
	 * @return ModelSurvey
	 */
	public function getSurvey()
	{
		if($this->survey === false)
		{
			$columns = ['*'];
			$filters = [
				'eq' => [
					'field' => 'survey_id',
					'value' => $this->getSurveyId()
				],
			];
			$joins = [];
			$sort = [];
			$paginate = 1;
			$options = [];
			$this->survey = $this->getRepo('surveys')->getAll($columns, $filters, $sort, $joins, $paginate, $options, false)->first();
			if(empty($this->survey->count()))
			{
				$this->addMessage('empty', $this->index(), 'Survey not found.');
			}
		}
		return $this->survey;
	}

	/**
	 * Return questions by set
	 * @return Collection of QuestionSet
	 */
	public function getSets()
	{
		if($this->questionSets === false)
		{
			$columns = ['*'];
			$filters = [
				'eq' => [
					'field' => 'survey_id',
					'value' => $this->getSurveyId()
				],
				'eq' => [
					'field' => 'status',
					'value' => 1
				]
			];
			$joins = [];
			$sort = ['position' => 'ASC'];
			$paginate = $this->getConfig('models.questionsSet.repository.perpage', 1);
			$options = [];
			$this->questionSets = $this->getRepo('questionsSets')->getAll($columns, $filters, $sort, $joins, $paginate, $options, false);
			if(empty($this->questionSets->count()))
			{
				$this->addMessage('empty', $this->index(), 'No question sets found.');
			}
		}
		return $this->questionSets;
	}

	/**
	 * Return the Rows
	 * @return LengthAwarePaginator
	 */
	public function getQuestions()
	{
		if($this->useSet())
		{
			return $this->getSets();
		}
		if($this->questions === false)
		{
			$columns = ['*'];
			$filters = [
				'eq' => [
					'field' => 'survey_id',
					'value' => $this->getSurveyId()
				],
//				'eq' => [
//					'field' => 'status',
//					'value' => 1
//				]
			];
			$joins = [];
			$sort = ['position' => 'ASC'];
			$paginate = $this->getConfig('models.questions.repository.perpage', 1);
			$options = [];
			$this->questions = $this->getRepo('questions')->getAll($columns, $filters, $sort, $joins, $paginate, $options, false);
			if(empty($this->questions->count()))
			{
				$this->addMessage('empty', $this->index(), 'No questions found.');
			}
		}
		return $this->questions;
	}

	// </editor-fold>

	/**
	 * Create a formWidget out of Survey Widget
	 */
	public function _formWidget()
	{

	}

	/**
	 * Return the Survey View
	 */
	public function getWidget()
	{
		$defaultView = cd_survey_view_name('widgets.survey.survey');
		$view = $this->getConfig('view.survey', $defaultView);
		return $this->view($view, $defaultView, array('widget' => $this));
	}

	/**
	 * Prepare the widget
	 */
	public function prepare()
	{
		if(!$this->prepared)
		{
			$this->_formWidget();
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
		return $this->getWidget();
	}

	/**
	 * Render an answer
	 * @param \Claremontdesign\Cdsurvey\Model\Contracts\AnswerInterface $answer
	 */
	public function answer(ModelAnswerInterface $answer)
	{
		switch ($answer->type())
		{
			case 'dropdownselect':
				break;
			default;
		}
	}

}
