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
class CartController extends Zend_Controller_Action
{
	/**
	 * @var Zend_Controller_Action_Helper_FlashMessenger
	 */
	protected $_flashMessenger;

	public function init()
	{
		$this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
	}

	public function indexAction()
	{
		
	}

	public function addAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();
	
		if (($id = (int) $this->_getParam('id', 0)) <= 0) {
			$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect('/cart/view');
		}
		
		$modelCart = new Model_Cart();
		if ($modelCart->add($id))
			$this->_flashMessenger->addMessage(array('success', 1));
		else
			$this->_flashMessenger->addMessage(array('error', 0));
			
		$this->_redirect('/cart/view');
	}

	public function removeAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();
	
		if (($id = (int) $this->_getParam('id', 0)) <= 0) {
			$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect('/cart/view');
		}
		
		$modelCart = new Model_Cart();
		if ($modelCart->remove($id))
			$this->_flashMessenger->addMessage(array('success', 1));
		else
			$this->_flashMessenger->addMessage(array('error', 0));
			
		$this->_redirect('/cart/view');
	}

	public function viewAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("cart");
		$this->view->headTitle($this->view->title);

		$modelCart = new Model_Cart();

		if ($this->getRequest()->isPost())
			$modelCart->updateAll($this->getRequest()->getPost());

		$this->view->cart = $modelCart->getCart();
		$this->view->totalCost = $modelCart->getTotalCost();
		$this->view->totalItems = $modelCart->getTotalItems();
		
		if (strpos(@$_SERVER['HTTP_REFERER'], @$_SERVER['HTTP_HOST']) !== false AND 
			strpos(@$_SERVER['HTTP_REFERER'], 'cart') === false)
			$ref = $_SERVER['HTTP_REFERER'];
		else
			$ref = '/';
		$this->view->ref = $ref;
	}

	public function emptyAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();
	
		$modelCart = new Model_Cart();
		if ($modelCart->removeAll())
			$this->_flashMessenger->addMessage(array('success', 1));
		else
			$this->_flashMessenger->addMessage(array('error', 0));
			
		$this->_redirect('/cart/view');
	}
}

