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
class Admin_Form_Currency extends Admin_Form_Base
{
	public function init()
	{
		$this->setName('currency');

		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('name')
			->addFilter('StripTags')
			->addFilter('StringTrim');
			
		$short_name = new Zend_Form_Element_Text('short_name');
		$short_name->setLabel('short_name')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$rate = new Zend_Form_Element_Text('rate');
		$rate->setLabel('rate')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('add')
			->removeDecorator('DtDdWrapper');

		$this->addElements(array($name, $short_name, $rate, $submit));
	}
}