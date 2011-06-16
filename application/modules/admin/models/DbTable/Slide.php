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
class Admin_Model_DbTable_Slide extends Zend_Db_Table_Abstract
{
	protected $_name = 'slides';

	/**
	 * @param array $formData
	 * @return boolean|integer
	 */
	public function add($formData)
	{
		$insertData = array(
			'content'	 => $formData['content'],
			'start'		 => $formData['start'],
			'end'		 => $formData['end'],
			'order'		 => $formData['order'],
			'group_id'	 => $formData['group_id'],
		);
		
		if (($to = strpos($formData['p_images'], ';')) !== false)
			$insertData['images'] = substr($formData['p_images'], 0, $to);
		else
			$insertData['images'] = $formData['p_images'];

		try {
			$result = $this->insert($insertData);
		} catch (Zend_Db_Statement_Exception $ex) {
			return false;
		}

		return $result;
	}

	/**
	 * @param integer $id
	 * @return array
	 */
	public function getSlide($id)
	{
		$select = $this->select();
		$select->where('id = ?', (int) $id);

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
			'content'	 => $formData['content'],
			'start'		 => $formData['start'],
			'end'		 => $formData['end'],
			'order'		 => $formData['order'],
			'group_id'	 => $formData['group_id'],
		);
		
		if (($to = strpos($formData['p_images'], ';')) !== false)
			$updateData['images'] = substr($formData['p_images'], 0, $to);
		else
			$updateData['images'] = $formData['p_images'];

		try {
			$this->update($updateData, 'id=' . (int) $id);
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
	 * @param array $param
	 * @return Zend_Paginator
	 */
	public static function getPaginator($param = array())
	{
		$current = (isset($param['page'])) ? $param['page'] : 1;
		$order = (isset($param['order'])) ? $param['order'] : 'group_id';
		$order2 = (isset($param['order2'])) ? $param['order2'] : 'asc';
		$count = (isset($param['count'])) ? $param['count'] : 10;

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect(self::getDefaultAdapter()
			->select()
			->from('slides')
			->join('slide_groups', '`slides`.`group_id`=`slide_groups`.`id`', array('group_name' => 'slide_groups.name'))
			->order("$order $order2")));

		$paginator->setItemCountPerPage($count)
			->setCurrentPageNumber($current);

		return $paginator;
	}
}
