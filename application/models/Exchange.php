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
class Model_Exchange implements Zend_Currency_CurrencyInterface
{
	/**
	 * @var string
	 */
	protected $_defaultCurrency;
	
	/**
	 * @var array
	 */
	protected $_exchangeRates;

	public function __construct()
	{
		$this->_defaultCurrency = Zend_Registry::get('config')->currency->default;
		$this->_exchangeRates = Admin_Model_DbTable_Currency::getRates();
	}
	
	/**
	 * @param integer|string $value number
	 * @param string $currency
	 * @return Zend_Currency
	 */
	public function exchange($value, $currency)
	{
		if (!key_exists($currency, $this->_exchangeRates))
			$currency = $this->_defaultCurrency;
			
		$currency = new Zend_Currency($currency);
		$currency->setService($this);
		$currency->setValue(0, $this->_defaultCurrency);
		$currency->add($value, $this->_defaultCurrency);
		
		return $currency;
	}

	/* (non-PHPdoc)
	 * @see Currency/Zend_Currency_CurrencyInterface::getRate()
	 */
	public function getRate($from, $to)
	{
		if ($from != $this->_defaultCurrency) {
			throw new Exception("We can only exchange " . $this->_defaultCurrency);
		}

		if (key_exists($to, $this->_exchangeRates)) {
			return $this->_exchangeRates[$to];
		} else {
			throw new Exception("Unable to exchange $to");
		}
	}
}
