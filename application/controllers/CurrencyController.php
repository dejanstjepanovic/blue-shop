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
class CurrencyController extends Zend_Controller_Action
{
    public function init()
    {
    	
    }

    public function indexAction()
    {
    	
    }

    public function changeAction()
    {
    	$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();
		
		if ($this->_request->isPost()) {
			$form = new Form_ChangeCurrency();
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				Zend_Registry::get('visitor_data')->currency = $formData['currency'];
			}
		}
		
		if (strpos(@$_SERVER['HTTP_REFERER'], @$_SERVER['HTTP_HOST']) !== false)
			$ref = $_SERVER['HTTP_REFERER'];
		else
			$ref = '/';
		$this->_redirect($ref);
    }
}



