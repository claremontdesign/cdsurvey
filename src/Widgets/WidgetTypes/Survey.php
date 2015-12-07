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
use Claremontdesign\Cdbase\Exceptions\Runtime as RuntimeException;
use Claremontdesign\Cdbase\Widgets\WidgetTypes\Widget;
use Claremontdesign\Cdbase\Traits\Repository;
use Claremontdesign\Cdsurvey\Model\Contracts\SurveyInterface as ModelSurveyInterface;
use Claremontdesign\Cdsurvey\Model\Contracts\AnswerInterface as ModelAnswerInterface;
use Claremontdesign\Cdbase\Form\Contracts\FormInterface;
use Claremontdesign\Cdbase\Http\Controllers\Controller;

class Survey extends Widget implements FormInterface
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
	protected $questions = [];

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
	 * The Result Object
	 * @var ModelResult
	 */
	protected $result = false;

	/**
	 * The REsult Answers
	 * @var Collection of ResultAnswers
	 */
	protected $resultAnswers = false;

	/**
	 * Collection of Surveys
	 * @var Collection
	 */
	protected $surveys = false;

	/**
	 * Check if Survey is OK
	 * @var type
	 */
	protected $hasSurvey = false;

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
		$this->questions = collect($this->questions);
		return $this;
	}

	/**
	 * Retur the Survey Id
	 * @return integer
	 */
	public function getSurveyId()
	{
		return $this->widget()->getParameter('surveyId');
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
	 * Has Survey Id Given
	 * @return type
	 */
	public function hasSurveyId()
	{
		return !empty($this->getSurveyId());
	}

	/**
	 * Retur the Result Id
	 * @return integer
	 */
	public function getResultId()
	{
		return $this->widget()->getParameter('resultId');
	}

	/**
	 * Return the Result Object
	 * @return ModelResults
	 */
	public function getResult()
	{
		if($this->result === false)
		{
			$this->result = $this->getRepo('result')->byId($this->getSurvey(), $this->getResultId());
			if(!empty($this->result))
			{
				$this->getResultAnswers();
			}
		}
		return $this->result;
	}

	/**
	 * Return the Answers
	 * @return Collection of ModelResultAnswers
	 */
	public function getResultAnswers()
	{
		if($this->resultAnswers === false)
		{
			$this->resultAnswers = null;
			if($this->hasResult())
			{
				$answers = $this->fetchAnswers();
				if(!empty($answers))
				{
					$this->resultAnswers = collect([]);
					foreach ($answers as $answer)
					{
						$this->resultAnswers->put($answer->question_id . '_' . $answer->answer_id, $answer);
					}
					return true;
				}
			}
		}
		return $this->resultAnswers;
	}

	/**
	 * Check if showing Answers
	 * @return boolean|ModelResult
	 */
	public function hasResult()
	{
		if($this->hasSurvey())
		{
			return !empty($this->getResult());
		}
		return false;
	}

	/**
	 * Check this hasQuestions
	 * @return boolean
	 */
	public function hasSurvey()
	{
		return $this->hasSurvey;
	}

	/**
	 * Return the Survey Object
	 * @return ModelSurvey
	 */
	public function getSurvey()
	{
		if($this->survey === false)
		{
			$this->survey = $this->getRepo('surveys')->byId($this->getSurveyId());
		}
		return $this->survey;
	}

	/**
	 * REturn enabled Surveys
	 * @return Collection
	 */
	public function getAllEnabled()
	{
		if($this->surveys === false)
		{
			$this->surveys = $this->getRepo('surveys')->getAllEnabled();
		}
		return $this->surveys;
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
				[
					'eq' => [
						'field' => 'survey_id',
						'value' => $this->getSurveyId()
					],
				],
				[
					'eq' => [
						'field' => 'status',
						'value' => 1
					]
				]
			];
			$joins = [];
			$sort = ['position' => 'ASC'];
			$paginate = $this->getConfig('models.questionsSet.repository.perpage', 1);
			$options = [];
			$questionSets = $this->getRepo('questionsSets')->getAll($columns, $filters, $sort, $joins, $paginate, $options, false);
			return $questionSets;
		}
	}

	/**
	 * Return the Rows
	 * @return LengthAwarePaginator
	 */
	public function fetchQuestions()
	{
		$columns = ['*'];
		$filters = [
			[
				'eq' => [
					'field' => 'survey_id',
					'value' => $this->getSurveyId()
				],
			],
			[
				'eq' => [
					'field' => 'status',
					'value' => 1
				]
			]
		];
		$joins = [];
		$sort = ['position' => 'DESC'];
		$paginate = $this->getQuestionsPerPage();
		$options = [];
		$questions = $this->getRepo('questions')->getAll($columns, $filters, $sort, $joins, $paginate, $options, false);
		return $questions;
	}

	/**
	 * Return questions per page
	 * @return integer
	 */
	public function getQuestionsPerPage()
	{
		return $this->getConfig('models.questions.repository.perpage', 1);
	}

	/**
	 * Return the Answers
	 */
	public function fetchAnswers()
	{
		return $this->getRepo('resultAnswers')->byResult($this->getResult());
	}

	/**
	 * Return questions
	 * @return type
	 */
	public function getPreparedQuestions()
	{
		return $this->questions;
	}

	// </editor-fold>

	/**
	 * Return the Survey View
	 */
	public function getWidget()
	{
		$defaultView = $this->getViewName('widgets.survey.survey');
		$view = $this->getConfig('view.survey', $defaultView);
		return $this->view($view, $defaultView, array('widget' => $this));
	}

	/**
	 * REturn Done Message
	 * @return View
	 */
	public function getDoneMessage()
	{
		if($this->isDone())
		{
			$view = $this->getConfig('view.done', $this->getViewName('widgets.survey.partial.done'));
			return $this->view($view, null, array('widget' => $this));
		}
		if($this->isFinish())
		{
			$view = $this->getConfig('view.done', $this->getViewName('widgets.survey.partial.finish'));
			return $this->view($view, null, array('widget' => $this));
		}
	}

	/**
	 * Return the View Name
	 * @param type $viewName
	 * @return type
	 */
	public function getViewName($viewName)
	{
		return cd_survey_view_name($viewName);
	}

	/**
	 * Prepare the widget
	 */
	public function prepare()
	{
		if(!$this->prepared)
		{
			$this->processQuestions();
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
		if($this->validate())
		{
			return $this->postProcess();
		}
		return $this->getWidget();
	}

	/**
	 * Return CrudAction
	 * @return string
	 */
	public function crudAction()
	{
		return 'create';
	}

	/**
	 * PreSave RESULT MODEL
	 * @param type $result
	 * @return type
	 */
	public function resultPreSave($result)
	{
		return $result;
	}

	/**
	 * PreSave Answer
	 * @param type $answer
	 * @return type
	 */
	public function answerPreSave($answer)
	{
		return $answer;
	}

	/**
	 * PostProcess Widget
	 */
	public function postProcess()
	{
		$questions = $this->getPreparedQuestions();
		if($questions->currentPage() == $questions->lastPage())
		{
			$survey = $this->getSurvey();
			\DB::beginTransaction();
			try
			{
				$class = $this->getRepo('result')->repo()->getModel();
				$result = [
					'survey_id' => $this->getSurvey()->id(),
					'start_at' => date('Y-m-d H:i:s'),
					'is_new' => 1,
					'end_at' => date('Y-m-d H:i:s'),
					'ip_address' => $this->widget()->request()->ip(),
					'status' => 1
				];
				$result['customer_id'] = null;
				$result = $this->resultPreSave($result);
				$resultModel = $class->create($result);
				$sessionValues = $this->widget()->request()->session()->all();
				if(!empty($sessionValues))
				{
					foreach ($sessionValues as $sK => $sV)
					{
						if(preg_match('/survey_form_' . $survey->id() . '/', $sK))
						{
							$x = explode('_', $sK);
							if(count($x) == 5)
							{
								$a = [
									'question_id' => $x[3],
									'answer_id' => $x[4],
									'answer' => $sV,
									'result_id' => $resultModel->id()
								];
								$resultModel->answers()->insert($a);
								$this->widget()->request()->session()->forget($sK);
							}
						}
					}
				}
			} catch (RuntimeException $e)
			{
				\DB::rollBack();
				$this->setHasError(true);
				cd_flash_errormsg('There was an error saving information to database. Kindly try again.');
			}
			\DB::commit();
			$this->widget()->request()->session()->forget('surveyRequest');
			$this->widget()->request()->session()->forget('surveyPage');
			$this->widget()->request()->session()->flash('surveyFinish', true);
			$this->widget()->request()->session()->flash('surveyFinish' . $this->getSurveyId(), true);
			$this->widget()->request()->session()->put('surveyDone', true);
			$this->widget()->request()->session()->put('surveyDone' . $this->getSurveyId(), true);
			$this->fireEvent('finish');
			return redirect($this->getDoneUrl());
		}
		else
		{
			$nextPage = $questions->currentPage() + 1;
			$this->widget()->request()->session()->put('surveyPage', $nextPage);
			return redirect($this->getSurveyUrl() . '?page=' . $nextPage);
		}
	}

	/**
	 * Done URL
	 * @return type
	 */
	public function getDoneUrl()
	{
		return $this->getSurveyUrl() . '?done=1';
	}

	/**
	 * Return this survey URL
	 * @return string
	 */
	public function getSurveyUrl($survey = null)
	{
		$config = $this->getConfig('url');
		if($survey instanceof ModelSurveyInterface)
		{
			$config['route'][$this->getRequestIndex()] = $survey->id();
		}
		return $this->getUrl(null, $config);
	}

	/**
	 * Return this survey URL
	 * @return string
	 */
	public function getSurveyResultsUrl($survey = null)
	{
		$config = [
			'route' => [
				'name' => 'Module',
				'module' => 'surveys-results'
			],
		];
		if($survey instanceof ModelSurveyInterface)
		{
			$config['route'][$this->getRequestIndex()] = $survey->id();
		}
		return $this->getUrl(null, $config);
	}

	/**
	 * REturn the REquest Iondex
	 * @return integer
	 */
	public function getRequestIndex()
	{
		return $this->getConfig('request.index', 'record');
	}

	/**
	 * Check if survey was made already
	 */
	public function isDone()
	{
		if($this->widget()->request()->session()->has('surveyDone'))
		{
			return true;
		}
		return false;
	}

	/**
	 * Check if survey is finished already
	 * @return boolean
	 */
	public function isFinish()
	{
		if($this->widget()->request()->session()->has('surveyFinish'))
		{
			return true;
		}
		return false;
	}

	/**
	 *
	 * @return null
	 */
	protected function processQuestions()
	{
		$survey = $this->getSurvey();
		$questions = $this->fetchQuestions();
		$messageBag = $this->widget()->request()->session()->pull('formError');
		if($survey instanceof ModelSurveyInterface && !$questions->isEmpty())
		{
			$this->questions = $questions;
			$validators = $this->collect([]);
			$validatorsMessages = $this->
					collect([]);
			$i = 0;
			foreach ($questions as $question)
			{
				$answers = $question->getAnswers();
				if(!$answers->isEmpty())
				{
					$this->hasSurvey = true;
					$x = 0;
					foreach ($answers as $answer)
					{
						if($answer->isEnabled())
						{
							$element = $this->createElement($answer);
							$element->setCounter(0);
							$element->setMessageBag($messageBag);
							if($this->validate())
							{
								$input = $this->widget()->request()->input($element->index());
								if(empty($input))
								{
									$input = [0 => ''];
								}
								if(!empty($input))
								{
									foreach ($input as $y => $v)
									{
										$element->validate($v);
										$this->widget()->request()->session()->put('survey_form_' . $survey->id() . '_' . $question->id() . '_' . $answer->id(), $element->value());
										$validators = $validators->merge($element->validations()->get('validators'));
										$validatorsMessages = $validatorsMessages->merge($element->validations()->get('messages'));
									}
								}
							}
							else
							{
								if($this->hasResult())
								{
									$resultAnswer = $this->resultAnswers->get($question->id() . '_' . $answer->id());
									if(!empty($resultAnswer))
									{
										$element->setValue($resultAnswer->getAnswer());
									}
								}
							}
							$answer->setElement($element);
							$question->preparedAnswers()->put($x, $answer);
							$x++;
						}
					}
					$this->questions->put($i, $question);
					$i++;
				}
			}
			if($this->validate())
			{
				$this->widget()->controller()->validate($this->widget()->request(), $validators->toArray(), $validatorsMessages->toArray());
			}
		}
		if(!$this->hasSurvey() && $this->hasSurveyId())
		{
			cd_flash_errormsg('Survey not found.');
		}
	}

	/**
	 * Render an answer
	 * @param \Claremontdesign\Cdsurvey\Model\Contracts\AnswerInterface $answer
	 */
	public function createElement(ModelAnswerInterface $answer)
	{
		$type = $answer->type();
		$config = [
			'enable' => true,
			'model' => [
				'value' => [ 'index' => null,
				],
			],
			'position' => $answer
					->position(), 'attributes'
			=> [
				'label' => $answer->label(),
				'placeholder' => $answer->label()
			],
			'validation' => [
				'required' => [
					'enable' => $answer->isRequired(),
					'message' => $answer->label() . ' is required.'
				],
			],
		];

		$inputType = 'text';
		$hasSelections = false;
		switch ($type)
		{
			case 'yesno':
				$hasSelections = true;
				$class = cd_config('form.classes.elements.radio');
				$inputType = 'select';
				$config['select']['type'] = 'select';
				$config['select']['options']['options'] = 'yesno';
				break;
			case 'radio':
				$hasSelections = true;
				$class = cd_config('form.classes.elements.radio');
				$inputType = 'radio';
				$config['select']['type'] = 'radio';
				$answerOptions = $answer->getOptions();
				$selections = [];
				if(!empty($answerOptions))
				{
					foreach ($answerOptions as $option)
					{
						$selections[$option->value()] = $option->label();
					}
				}
				$config['select']['options']['array'] = $selections;
				break;
			case 'checkbox':
				$hasSelections = true;
				$class = cd_config('form.classes.elements.checkbox');
				$inputType = 'checkbox';
				$config['select']['type'] = 'checkbox';
				$answerOptions = $answer->getOptions();
				$selections = [];
				if(!empty($answerOptions))
				{
					foreach ($answerOptions as $option)
					{
						$selections[$option->value()] = $option->label();
					}
				}
				$config['select']['options']['array'] = $selections;
				break;
			case 'textarea':
				$class = cd_config('form.classes.elements.textarea');
				$inputType = 'textarea';
				break;
			case 'numeric':
				$class = cd_config('form.classes.elements.text');
				$inputType = 'number';
				break;
			case 'date':
				$class = cd_config('form.classes.elements.text');
				$inputType = 'date';
				break;
			default;
				$class = cd_config('form.classes.elements.text');
		}
		$config['type'] = $inputType;
		$config['help']['description'] = $answer->description();
		if($answer->isRequired())
		{
			$config['validation']['required']['enable'] = true;
			$config['validation']['required']['message'] = 'Required.';
		}
		else
		{
			$config['validation']['required']['enable'] = false;
		}
		$index = 'answer' . $answer->id();
		$tab = null;
		$fieldset = null;
		$element = new $class($index, $config, $this, $tab, $fieldset, $this->widget()->request(), $this->crudAction());
		return $element;
	}

	/**
	 * REturn SurveyData
	 * @return ModelSurvey
	 */
	public function getData()
	{

		return $this->getSurvey();
	}

	public function validate()
	{

		return $this->isPosting() && $this->widget()->controller() instanceof Controller;
	}

	public function valueIndex()
	{

		return 'survey_id';
	}

}
