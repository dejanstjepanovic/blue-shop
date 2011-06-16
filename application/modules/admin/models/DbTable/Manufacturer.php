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
class Admin_Model_DbTable_Manufacturer extends Zend_Db_Table_Abstract
{
	protected $_name = 'manufacturers';

	/**
	 * @param array $formData
	 * @return boolean|integer
	 */
	public function add($formData)
	{
		$insertData = array(
			'man_name'			 => $formData['man_name'],
			'man_description'	 => $formData['man_description'],
			'man_publish'		 => $formData['man_publish'],
			'man_created'		 => date('Y-m-d H:i:s'),
		);

		$insertData['man_code'] = ($formData['man_code'] != '') ? $formData['man_code'] : NULL;
		$insertData['man_tags'] = ($formData['man_tags'] != '') ? $formData['man_tags'] : NULL;

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
	public function getManufacturer($id)
	{
		$select = $this->select();
		$select->where('man_id = ?', (int) $id);

		return $select->query()->fetch();
	}

	/**
	 * @return array ; all manufacturers in format man_id=>man_name
	 */
	public static function getList()
	{
		$result = parent::getDefaultAdapter()
			->select()
			->from('manufacturers', array('man_id', 'man_name'))
			->query()
			->fetchAll();

		$list = array();
		foreach ($result AS $sec) {
			$list[$sec['man_id']] = $sec['man_name'];
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
			'man_name'			 => $formData['man_name'],
			'man_description'	 => $formData['man_description'],
			'man_publish'		 => $formData['man_publish'],
			'man_updated'		 => date('Y-m-d H:i:s'),
		);

		$updateData['man_code'] = ($formData['man_code'] != '') ? $formData['man_code'] : NULL;
		$updateData['man_tags'] = ($formData['man_tags'] != '') ? $formData['man_tags'] : NULL;

		try {
			$this->update($updateData, 'man_id=' . (int) $id);
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
			$this->delete('man_id=' . (int) $id);
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
		$order = (isset($param['order'])) ? $param['order'] : 'man_id';
		$order2 = (isset($param['order2'])) ? $param['order2'] : 'asc';
		$count = (isset($param['count'])) ? $param['count'] : 1;

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect(self::getDefaultAdapter()
			->select()
			->from('manufacturers')
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
			if (strpos($msg, 'man_name') !== false) {
				$view->form->man_name->addErrors(array('already_in_use'));
				return true;
			}
			if (strpos($msg, 'man_code') !== false) {
				$view->form->man_code->addErrors(array('already_in_use'));
				return true;
			}
		}
		return false;
	}
}
