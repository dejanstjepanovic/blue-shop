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
class Model_Product extends Zend_Db_Table_Abstract
{
	protected $_name = 'products';

	/**
	 * @param integer $id
	 * @return array
	 */
	public static function getProduct($id)
	{
		$select = self::getDefaultAdapter()
			->select()
			->from('products')
			->join('manufacturers', '`products`.`man_id`=`manufacturers`.`man_id`', array('manufacturers.man_name'))
			->join('categories', '`products`.`cat_id`=`categories`.`cat_id`', array('categories.cat_name'))
			->join('sections', '`categories`.`sec_id`=`sections`.`sec_id`', array('sections.sec_name'))
			->where('p_id = ?', (int) $id)
			->where('p_publish="yes"');

		return $select->query()->fetch();
	}

	/**
	 * @param array $param
	 * @return Zend_Paginator
	 */
	public static function getFeatured()
	{
		$select = self::getDefaultAdapter()
			->select()
			->from('featured')
			->join('products', '`featured`.`p_id`=`products`.`p_id`', array('*'))
			->where('`featured`.`start`<NOW() AND `featured`.`expiration`>NOW()')
			->where('`products`.`p_publish`="yes"')
			->limit(6, 0);
			
		return $select->query()->fetchAll();
	}
}

