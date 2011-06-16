<?php
/**
 * BlueShop - eCommerce WebShop Solution
 *
 * Copyright (C) 2011 Dejan Stjepanovic
 *
 * This file is part of BlueShop.
 *
 * BlueShop is free software: you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published by 
 * the Free Software Foundation, either version 3 of the License, or 
 * (at your option) any later version.
 *
 * BlueShop is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU 
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License 
 * along with BlueShop. If not, see <http://www.gnu.org/licenses/>.
 */
 
/**
 * @author Dejan Stjepanovic <stj.dejan@gmail.com>
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License
 */
class Admin_Model_DbTable_Currency extends Zend_Db_Table_Abstract
{
	protected $_name = 'currencies';

	/**
	 * @param array $formData
	 * @return boolean|integer
	 */
	public function add($formData)
	{
		$insertData = array(
			'short_name' => strtoupper($formData['short_name']),
			'name'		 => $formData['name'],
		);

		$insertData['rate'] = ($formData['rate'] != '') ? $formData['rate'] : 1;

		try {
			$result = $this->insert($insertData);
		} catch (Zend_Db_Statement_Exception $ex) {
			if ($this->_setFormError($ex->getMessage()))
				return false;
			throw new Exception($ex->getMessage());
		}

		return $result;
	}

	/**
	 * @param integer $id
	 * @return array
	 */
	public function getCurrency($id)
	{
		$select = $this->select();
		$select->where('id = ?', (int) $id);

		return $select->query()->fetch();
	}

	/**
	 * @return array
	 */
	public static function getAllCurrencies()
	{
		$select = parent::getDefaultAdapter()
			->select()
			->from('currencies', array('*'));

		return $select->query()->fetchAll();
	}

	/**
	 * @return array ; short_name=>rate
	 */
	public static function getRates()
	{
		$result = parent::getDefaultAdapter()
			->select()
			->from('currencies', array('short_name', 'rate'))
			->query()
			->fetchAll();

		$rates = array();
		foreach ($result AS $sec) {
			$rates[$sec['short_name']] = $sec['rate'];
		}

		return $rates;
	}

	/**
	 * @param integer $id
	 * @param array $formData
	 * @return boolean
	 */
	public function edit($id, $formData)
	{
		$updateData = array(
			'short_name' => strtoupper($formData['short_name']),
			'name'		 => $formData['name'],
		);

		$updateData['rate'] = ($formData['rate'] != '') ? $formData['rate'] : 1;

		try {
			$this->update($updateData, 'id=' . (int) $id);
			return true;
		} catch (Zend_Db_Statement_Exception $ex) {
			if ($this->_setFormError($ex->getMessage()))
				return false;
			throw new Exception($ex->getMessage());
		}
	}

	/**
	 * @param array $formData
	 * @return boolean
	 */
	public function updateRates($formData)
	{
		$sql = "UPDATE `currencies` SET `rate` = CASE `short_name` ";
		foreach ($formData AS $k => $v)
			$sql .= "WHEN '$k' THEN '$v' ";
		$sql .= "END";
		
		try {
			parent::getDefaultAdapter()->query($sql);
			return true;
		} catch (Zend_Db_Statement_Exception $ex) {
			return false;
		}
	}

	/**
	 * @param integer $id
	 * @return boolean
	 */
	public function remove($id)
	{
		try {
			$this->delete('id=' . (int) $id);
			return true;
		} catch (Zend_Db_Statement_Exception $ex) {
			return false;
		}
	}

	/**
	 * @param string $msg; Zend_Db_Statement_Exception message
	 * @return boolean
	 */
	protected function _setFormError($msg)
	{
		$msg = strtolower($msg);
		if (strpos($msg, 'duplicate entry') !== false) {
			$view = Zend_Registry::get('view');
			if (strpos($msg, 'short_name') !== false) {
				$view->form->short_name->addErrors(array('already_in_use'));
				return true;
			}
		}
		return false;
	}
}
