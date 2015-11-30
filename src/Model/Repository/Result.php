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
use Claremontdesign\Cdsurvey\Model\Result as Model;

class Result extends Repository
{

	/**
	 * Find records by Id
	 * @param string $id
	 * @return Model
	 */
	public function byId($id)
	{
		$filters = [
			$this->_table() . '.' . $this->_primaryKey() => $id
		];
		return $this->_cast($this->repo->setDebug(false)->getAll($this->_columns(), $filters, [], $this->_joins(), false, [])->first());
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
		return $this->_casts($this->repo->setDebug(false)->getAll($this->_columns(), $filters, [], $this->_joins(), false, []));
	}

	/**
	 * Find records by Customer
	 * @param ModelCustomer $customer
	 * @return Model
	 */
	public function byCustomer($customer)
	{
		$filters = [
			$this->_table() . '.customer_id' => $customer->id()
		];
		return $this->_casts($this->repo->setDebug(false)->getAll($this->_columns(), $filters, [], $this->_joins(), false, []));
	}

	/**
	 * Find records by Question
	 * @param ModelQuestion $question
	 * @return Model
	 */
	public function byQuestion($question)
	{
		$filters = [
			$this->_table() . '.question_id' => $question->id()
		];
		return $this->_casts($this->repo->setDebug(false)->getAll($this->_columns(), $filters, [], $this->_joins(), false, []));
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
		return $this->_casts($this->repo->setDebug($debug)->getAll($this->_columns(), $filters, $sort, $this->_joins(), $paginate, $options));
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
