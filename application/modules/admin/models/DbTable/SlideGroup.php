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
class Admin_Model_DbTable_SlideGroup extends Zend_Db_Table_Abstract
{
	protected $_name = 'slide_groups';

	/**
	 * @param integer $id
	 * @return array
	 */
	public function getGroup($id)
	{
		$select = $this->select();
		$select->where('id = ?', (int) $id);

		return $select->query()->fetch();
	}

	/**
	 * @return array
	 */
	public static function getList()
	{
		$result = parent::getDefaultAdapter()
			->select()
			->from('slide_groups', array('id', 'name'))
			->query()
			->fetchAll();

		$list = array();
		foreach ($result AS $sec) {
			$list[$sec['id']] = $sec['name'];
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
			'name'		 => $formData['name'],
			'animPause'	 => $formData['animPause'],
			'animDur'	 => $formData['animDur'],
			'animTypeI'	 => $formData['animTypeI'],
			'animTypeD'	 => $formData['animTypeD'],
			'enabled'	 => $formData['enabled'],
		);

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
	 * @return array
	 */
	public static function getAllGroups()
	{
		$select = parent::getDefaultAdapter()
			->select()
			->from('slide_groups', array('*'));

		return $select->query()->fetchAll();
	}
}
