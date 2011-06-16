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
class Bs_Controller_Action_Helper_FlashMessenger extends Zend_Controller_Action_Helper_FlashMessenger
{
	public function __construct()
	{
		parent::__construct();
	}

	/* (non-PHPdoc)
	 * @see Controller/Action/Helper/Zend_Controller_Action_Helper_FlashMessenger::addMessage()
	 */
	public function addMessage($msg, $priority, $nameSpace = null)
	{
		if ($nameSpace)
			parent::setNamespace($nameSpace);
			
		parent::addMessage(array(
			$msg,
			$priority
		));
		
		return $this;
	}

	/* (non-PHPdoc)
	 * @see Controller/Action/Helper/Zend_Controller_Action_Helper_FlashMessenger::getMessages()
	 */
	public function getMessages($nameSpace)
	{
		parent::setNamespace($nameSpace);
		return parent::getMessages();
	}

}