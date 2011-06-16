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
class Admin_Form_CurrenciesRates extends Admin_Form_Base
{
	/**
	 * @var array
	 */
	protected $_rates;

	public function init()
	{
		$this->setName('currency_rates');

		$this->_rates = Admin_Model_DbTable_Currency::getRates();

		foreach ($this->_rates AS $n => $r) {
			$this->addElement(new Zend_Form_Element_Text($n, array(
				'required'	 => true,
				'label'		 => $n,
				'filters'	 => array(
					array('filter' => 'StringTrim'),
					array('filter' => 'StripTags')
				)
			)));
		}

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('add')
			->removeDecorator('DtDdWrapper');

		$this->addElements(array($submit));
	}

	public function populateFromDb()
	{
		$this->populate($this->_rates);
	}
}
