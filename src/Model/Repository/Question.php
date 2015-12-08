<?php

namespace Claremontdesign\Cdsurvey\Model\Repository;

/**
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
use Claremontdesign\Cdbase\Model\Repository\Repository;
use Claremontdesign\Cdsurvey\Model\Question as Model;
use Claremontdesign\Cdbase\Modules\RepositoryModuleInterface;

class Question extends Repository implements RepositoryModuleInterface
{

	/**
	 * Find records by Id
	 * @param integer $id
	 * @return Model
	 */
	public function byId($id)
	{
		$filters = [
			$this->_table() . '.' . $this->_primaryKey() => $id
		];
		return $this->_cast($this->repo->setDebug(false)->getAll($this->_columns(), $filters, $this->_sort(), $this->_joins(), false, [])->first());
	}

	/**
	 * Find records by Survey
	 * @param ModelSurvey $survey
	 * @return Model
	 */
	public function bySurvey($survey)
	{
		$filters = [
			$this->_table() . '.survey_id' => $survey->id()
		];
		return $this->_casts($this->repo->setDebug(false)->getAll($this->_columns(), $filters, $this->_sort(), $this->_joins(), false, []));
	}

	/**
	 * Find records by RecordId Id
	 * @see Traits\Repository::fetchRecord
	 * @param string $id
	 * @return Model
	 */
	public function byRecordId($id)
	{
		$filters = [
			$this->_table() . '.' . $this->_primaryKey() => $id
		];
		return $this->_cast($this->repo->setDebug(false)->getAll($this->_columns(), $filters, $this->_sort(), $this->_joins(), false, [])->first());
	}

	/**
	 * Find records by QuestionSet
	 * @param ModelQuestionSet $set
	 * @return Model
	 */
	public function bySet($set)
	{
		$filters = [
			$this->_table() . '.question_set_id' => $set->id()
		];
		return $this->_casts($this->repo->setDebug(false)->getAll($this->_columns(), $filters, $this->_sort(), $this->_joins(), false, []));
	}

	/**
	 * REturn all Rows
	 * @param array $columns
	 * @param array $filters
	 * @param array $sort
	 * @param array $joins
	 * @param array $paginate
	 * @param array $options
	 * @return Collection|null
	 */
	public function getAll($columns = ['*'], $filters = [], $sort = [], $joins = [], $paginate = [], $options = [], $debug = false)
	{
		return $this->_casts($this->repo->setDebug($debug)->getAll($this->_columns(), $filters, $this->_sort(), $this->_joins(), $paginate, $options));
	}

	/**
	 * Cast each Model
	 * @return Model
	 */
	protected function _cast($row)
	{
		return $row;
	}

	/**
	 * Cast Multiple Rows
	 * @param array $rows
	 * @return array
	 */
	protected function _casts($rows)
	{
		if(!$rows->isEmpty())
		{
			$i = 0;
			foreach ($rows as $row)
			{
				$rows->put($i, $this->_cast($row));
				$i++;
			}
		}
		return $rows;
	}


	/**
	 * Return Default Sorting
	 * @return type
	 */
	protected function _sort()
	{
		return [$this->_table() . '.position' => 'asc'];
	}

	/**
	 * Columns
	 */
	protected function _columns()
	{
		$columns = [
			$this->_table() . '.*'
		];
		return $columns;
	}

	/**
	 * Joins
	 */
	protected function _joins()
	{
		$joins = [];
		return $joins;
	}

	/**
	 * Return the user Table
	 * @return string
	 */
	protected function _table()
	{
		return $this->repo->getModel()->getTable();
	}

	/**
	 * Return the Primary Key
	 * @return string
	 */
	protected function _primaryKey()
	{
		return $this->repo->getModel()->getKeyName();
	}

}
