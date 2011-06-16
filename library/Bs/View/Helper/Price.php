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
class Bs_View_Helper_Price
{
	/**
	 * @var Model_Exchange
	 */
	protected static $_modelExchange;
	
	/**
	 * @var string
	 */
	protected static $_userCurrency;

	public function __construct()
	{
		self::$_modelExchange = new Model_Exchange();
		self::$_userCurrency = Zend_Registry::get('visitor_data')->currency;
	}
	
	/**
	 * @param number $value
	 * @return Zend_Currency
	 */
	public static function price($value)
	{
		if ($value === '')
			return '- -';
			
		if (!is_numeric($value))
			return $value;
			
		return self::$_modelExchange->exchange($value, self::$_userCurrency);
	}
}
