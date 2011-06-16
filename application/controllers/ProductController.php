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
class ProductController extends Zend_Controller_Action
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

	public function viewAction()
	{
		if (($id = (int) $this->_getParam('id', 0)) <= 0 || !($this->view->product = Model_Product::getProduct($id))) {
			$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect('/');
		}
		
		$this->view->title = $this->view->product['p_name'];
		$this->view->headTitle($this->view->title);
		
		$form = new Form_Comment();
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$modelComment = new Model_Comments();
				if ($modelComment->addComment($id, $form->getValues()) !== false) {
					$this->_flashMessenger->addMessage(array('success', 1));
				} else {
					$this->_flashMessenger->addMessage(array('error', 0));
				}
				$this->_redirect('/product/view/id/' . $id);
			} else {
				$form->populate($formData);
			}
		}
		
		$this->view->commPaginator = Model_Comments::getPaginator($id, $this->getRequest()->getUserParams());
	}

	public function listAction()
	{

	}
}

