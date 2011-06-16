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
class Form_Login extends Form_Base
{
	public function init()
	{
		$this->setName('login');
		
		$userName = new Zend_Form_Element_Text('username');
		$userName->setRequired(true)
			->setLabel('username')
			->setFilters(array('StringTrim', 'StripTags'))
			->setErrorMessages((array)'invalid_input');
			
		$password = new Zend_Form_Element_Password('password');
		$password->setRequired(true)
			->setLabel('password')
			->setFilters(array('StringTrim', 'StripTags'))
			->setErrorMessages((array)'invalid_input');
			
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('login');
		
		$this->addElements(array($userName, $password, $submit));
	}
}