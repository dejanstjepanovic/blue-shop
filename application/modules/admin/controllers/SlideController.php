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
class Admin_SlideController extends Zend_Controller_Action
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
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("slide_add");
		$this->view->headTitle($this->view->title);

		$form = new Admin_Form_Slide();
		$form->submit->setLabel(Zend_Registry::get('Zend_Translate')->translate('add'));
		$this->view->form = $form;

		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$modelSlide = new Admin_Model_DbTable_Slide();
				if ($modelSlide->add($form->getValues()))
					$this->_flashMessenger->addMessage(array('success', 1));
				else
					$this->_flashMessenger->addMessage(array('error', 0));
				$this->_redirect('/admin/slide/list');
			} else {
				$form->populate($formData);
			}
		}
	}

	public function listAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("slide_list");
		$this->view->headTitle($this->view->title);

		$this->view->urlParams = $this->getRequest()->getUserParams();
		$this->view->paginator = Admin_Model_DbTable_Slide::getPaginator($this->view->urlParams);
	}

	public function editAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("slide_edit");
		$this->view->headTitle($this->view->title);

		if (($id = (int) $this->_getParam('id', 0)) <= 0) {
			$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect('/admin/slide/list');
		}

		$form = new Admin_Form_Slide();
		$form->submit->setLabel(Zend_Registry::get('Zend_Translate')->translate('edit'));
		$this->view->form = $form;

		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$modelSlide = new Admin_Model_DbTable_Slide();
				if ($modelSlide->edit($id, $form->getValues()))
					$this->_flashMessenger->addMessage(array('success', 1));
				else
					$this->_flashMessenger->addMessage(array('error', 0));
				$this->_redirect('/admin/slide/list');
			} else {
				$form->populate($formData);
			}
		} else {
			$modelSlide = new Admin_Model_DbTable_Slide();
			if (($data = $modelSlide->getSlide($id)) != false) {
				//FIXME js for elfinder require id 'p_images'
				$data['p_images'] = $data['images'];
				$form->populate($data);
			} else {
				$this->_flashMessenger->addMessage(array('error', 0));
				$this->_redirect('/admin/slide/list');
			}
		}
	}

	public function deleteAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("slide_delete");
		$this->view->headTitle($this->view->title);

		if (($id = (int) $this->_getParam('id', 0)) <= 0) {
			$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect('/admin/slide/list');
		}

		$confirm = $this->_getParam('confirm', 0);

		if ($confirm === 'no') {
			$this->_redirect('/admin/slide/list');
		} elseif ($confirm === 'yes') {
			$modelSlide = new Admin_Model_DbTable_Slide();
			if ($modelSlide->remove($id)) {
				$this->_flashMessenger->addMessage(array('success', 1));
			} else {
				$this->_flashMessenger->addMessage(array('error', 0));
			}
			$this->_redirect('/admin/slide/list');
		}
	}
}

