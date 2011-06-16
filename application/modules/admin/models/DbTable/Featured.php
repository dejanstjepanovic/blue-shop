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
class Admin_Model_DbTable_Featured extends Zend_Db_Table_Abstract
{
	protected $_name = 'featured';

	/**
	 * @param array $formData
	 * @return boolean|integer
	 */
	public function add($id, $formData)
	{
		$insertData = array(
			'p_id'		 => $id,
			'start'		 => $formData['start'],
			'expiration' => $formData['expiration'],
		);

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
	public function getProduct($id)
	{
		$select = $this->select();
		$select->where('f_id = ?', (int) $id);

		return $select->query()->fetch();
	}

	/**
	 * @param integer $id
	 * @param array $formData
	 * @return boolean
	 */
	public function edit($id, $formData)
	{
		$updateData = array(
			'p_id'		 => $formData['p_id'],
			'start'		 => $formData['start'],
			'expiration' => $formData['expiration'],
		);

		try {
			$this->update($updateData, 'f_id=' . (int) $id);
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
			$this->delete('f_id=' . (int) $id);
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
		$order = (isset($param['order'])) ? $param['order'] : 'f_id';
		$order2 = (isset($param['order2'])) ? $param['order2'] : 'asc';
		$count = (isset($param['count'])) ? $param['count'] : 10;

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect(self::getDefaultAdapter()
			->select()
			->from('featured')
			->join('products', '`featured`.`p_id`=`products`.`p_id`', array('*'))
			->join('manufacturers', '`products`.`man_id`=`manufacturers`.`man_id`', array('manufacturers.man_name'))
			->join('categories', '`products`.`cat_id`=`categories`.`cat_id`', array('categories.cat_name'))
			->join('sections', '`categories`.`sec_id`=`sections`.`sec_id`', array('sections.sec_name'))
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
		if (strpos($msg, 'integrity constraint violation') !== false) {
			$view = Zend_Registry::get('view');
			if (strpos($msg, 'p_id') !== false) {
				$view->form->expiration->addErrors(array('product_does_not_exist'));
				return true;
			}
		}
		return false;
	}
}
