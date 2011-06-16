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
class Model_Cart
{
	/**
	 * @var Zend_Session_Namespace
	 */
	protected $_cart;

	public function __construct()
	{
		$this->_cart = new Zend_Session_Namespace('cart');
	}

	/**
	 * @param int $id
	 * @return boolean
	 */
	public function add($id)
	{
		if (!($productData = Model_Product::getProduct($id)))
			return false;
		
		if (isset($this->_cart->content[$productData['p_id']])) {
			$this->_cart->content[$productData['p_id']]['amount']++;
			return true;
		}
		$img = explode(';', $productData['p_images']);
		$img = (!empty($img[0])) ? $img[0] : 'default.jpg';
		
		$this->_cart->content[$productData['p_id']] = array(
			'p_id'		=>$productData['p_id'],
			'p_name'	=>$productData['p_name'],
			'cat_name'	=>$productData['cat_name'],
			'p_price'	=>$productData['p_price'],
			'p_img'		=>$img,
			'amount'	=>1
		);
		return true;
	}

	/**
	 * @param int $id
	 * @return boolean
	 */
	public function remove($id)
	{
		$id = (int) $id;
		unset($this->_cart->content[$id]);
		return true;
	}

	/**
	 * @return boolean
	 */
	public function removeAll()
	{
		unset($this->_cart->content);
		return true;
	}

	/**
	 * @param array $data
	 */
	public function updateAll($data)
	{
		if (!empty($data['remove']) AND is_array($data['remove'])) {
			foreach ($data['remove'] AS $key=>$val) {
				$this->remove($key);
			}
		}
		if (!empty($data['amount']) AND is_array($data['amount'])) {
			foreach ($data['amount'] AS $key=>$val) {
				$this->updateAmount($key, $val);
			}
		}
	}

	/**
	 * @param integer $id
	 * @param integer $amount
	 * @return boolean
	 */
	public function updateAmount($id, $amount)
	{
		$id = (int) $id;
		$amount = (int) $amount;
		
		if (isset($this->_cart->content[$id])) {
			$this->_cart->content[$id]['amount'] = $amount;
			return true;
		}
		
		return false;
	}
	
	/**
	 * @return array
	 */
	public static function getCart()
	{
		$cart = new Zend_Session_Namespace('cart');
		return (!empty($cart->content)) ? $cart->content : array();
	}

	/**
	 * @return number
	 */
	public static function getTotalCost()
	{
		$cart = new Zend_Session_Namespace('cart');
		
		if (empty($cart->content) OR !is_array($cart->content))
			return 0;
			
		$cost = 0;
		foreach ($cart->content AS & $item) {
			$cost += $item['p_price'] * $item['amount'];
		}
		
		return $cost;
	}

	/**
	 * @return number
	 */
	public static function getTotalAmount()
	{
		$cart = new Zend_Session_Namespace('cart');
		
		if (empty($cart->content) OR !is_array($cart->content))
			return 0;
			
		$amount = 0;
		foreach ($cart->content AS & $item) {
			$amount += $item['amount'];
		}
		
		return $amount;
	}
	
	/**
	 * @return number
	 */
	public static function getTotalItems()
	{
		$cart = new Zend_Session_Namespace('cart');
		
		if (empty($cart->content) OR !is_array($cart->content))
			return 0;
			
		return count($cart->content);
	}
}

