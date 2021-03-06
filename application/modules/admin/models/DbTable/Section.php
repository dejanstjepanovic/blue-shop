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
class Admin_Model_DbTable_Section extends Zend_Db_Table_Abstract
{
	protected $_name = 'sections';

	/**
	 * @param array $formData
	 * @return boolean|integer
	 */
	public function add($formData)
	{
		$insertData = array(
			'sec_name'			 => $formData['sec_name'],
			'sec_description'	 => $formData['sec_description'],
			'sec_publish'		 => $formData['sec_publish'],
			'sec_created'		 => date('Y-m-d H:i:s'),
		);

		$insertData['sec_code'] = ($formData['sec_code'] != '') ? $formData['sec_code'] : NULL;
		$insertData['sec_tags'] = ($formData['sec_tags'] != '') ? $formData['sec_tags'] : NULL;

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
	public function getSection($id)
	{
		$select = $this->select();
		$select->where('sec_id = ?', (int) $id);

		return $select->query()->fetch();
	}

	/**
	 * @return array ; all sections in format sec_id=>sec_name
	 */
	public static function getList()
	{
		$result = parent::getDefaultAdapter()
			->select()
			->from('sections', array('sec_id', 'sec_name'))
			->query()
			->fetchAll();

		$list = array();
		foreach ($result AS $sec) {
			$list[$sec['sec_id']] = $sec['sec_name'];
		}

		return $list;
	}

	/**
	 * @param integer $id
	 * @param array $formData
	 * @return boolean
	 */
	public function edit($id, $formData)
	{
		$updateData = array(
			'sec_name'			 => $formData['sec_name'],
			'sec_description'	 => $formData['sec_description'],
			'sec_publish'		 => $formData['sec_publish'],
			'sec_updated'		 => date('Y-m-d H:i:s'),
		);

		$updateData['sec_code'] = ($formData['sec_code'] != '') ? $formData['sec_code'] : NULL;
		$updateData['sec_tags'] = ($formData['sec_tags'] != '') ? $formData['sec_tags'] : NULL;

		try {
			$this->update($updateData, 'sec_id=' . (int) $id);
			return true;
		} catch (Zend_Db_Statement_Exception $ex) {
			if ($this->_setFormError($ex->getMessage()))
				return false;
			throw new Exception($ex->getMessage());
		}
	}

	/**
	 * @param integer $id
	 * @return boolean
	 */
	public function remove($id)
	{
		try {
			$this->delete('sec_id=' . (int) $id);
			return true;
		} catch (Zend_Db_Statement_Exception $ex) {
			return false;
		}
	}

	/**
	 * @param array $param
	 * @return Zend_Paginator
	 */
	public static function getPaginator($param = array())
	{
		$current = (isset($param['page'])) ? $param['page'] : 1;
		$order = (isset($param['order'])) ? $param['order'] : 'sec_id';
		$order2 = (isset($param['order2'])) ? $param['order2'] : 'asc';
		$count = (isset($param['count'])) ? $param['count'] : 10;

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect(self::getDefaultAdapter()
			->select()
			->from('sections')
			->order("$order $order2")));

		$paginator->setItemCountPerPage($count)
			->setCurrentPageNumber($current);

		return $paginator;
	}

	/**
	 * @param string $msg Zend_Db_Statement_Exception message
	 * @return boolean
	 */
	protected function _setFormError($msg)
	{
		$msg = strtolower($msg);
		if (strpos($msg, 'duplicate entry') !== false) {
			$view = Zend_Registry::get('view');
			if (strpos($msg, 'sec_name') !== false) {
				$view->form->sec_name->addErrors(array('already_in_use'));
				return true;
			}
			if (strpos($msg, 'sec_code') !== false) {
				$view->form->sec_code->addErrors(array('already_in_use'));
				return true;
			}
		}
		return false;
	}
}
