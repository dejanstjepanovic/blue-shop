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
class Model_Slider extends Zend_Db_Table_Abstract
{
	protected $_name = 'slides';

	/**
	 * @param integer $id
	 * @return array
	 */
	public static function getSlides($group_id)
	{
		$select = self::getDefaultAdapter()
			->select()
			->from('slides')
			->join('slide_groups', '`slides`.`group_id`=`slide_groups`.`id`', array('*'))
			->where('slides.group_id = ?', (int) $group_id)
			->where('`slides`.`start`<NOW() AND `slides`.`end`>NOW()')
			->where('slide_groups.enabled=1');

		return $select->query()->fetchAll();
	}

	/**
	 * @param array $param
	 * @return Zend_Paginator
	 */
	public static function getGroupOtions($group_id)
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

