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
class Admin_CurrencyController extends Zend_Controller_Action
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
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("currency_add");
		$this->view->headTitle($this->view->title);

		$form = new Admin_Form_Currency();
		$form->submit->setLabel(Zend_Registry::get('Zend_Translate')->translate('add'));
		$this->view->form = $form;

		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$modelCurrency = new Admin_Model_DbTable_Currency();
				if ($modelCurrency->add($formData)) {
					$this->_flashMessenger->addMessage(array('success', 1));
					$this->_redirect('/admin/currency/list');
				}
			} else {
				$form->populate($formData);
			}
		}
	}

	public function listAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("currency_list");
		$this->view->headTitle($this->view->title);

		$this->view->urlParams = $this->getRequest()->getUserParams();
		$this->view->currencies = Admin_Model_DbTable_Currency::getAllCurrencies();
	}

	public function editAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("currency_edit");
		$this->view->headTitle($this->view->title);

		if (($id = (int) $this->_getParam('id', 0)) <= 0) {
			$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect('/admin/currency/list');
		}

		$form = new Admin_Form_Currency();
		$form->submit->setLabel(Zend_Registry::get('Zend_Translate')->translate('edit'));
		$this->view->form = $form;

		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$modelCurrency = new Admin_Model_DbTable_Currency();
				if ($modelCurrency->edit($id, $formData)) {
					$this->_flashMessenger->addMessage(array('success', 1));
					$this->_redirect('/admin/currency/list');
				}
			} else {
				$form->populate($formData);
			}
		} else {
			$modelCurrency = new Admin_Model_DbTable_Currency();
			if (($data = $modelCurrency->getCurrency($id)) != false) {
				$form->populate($data);
			} else {
				$this->_flashMessenger->addMessage(array('error', 0));
				$this->_redirect('/admin/currency/list');
			}
		}
	}

	public function deleteAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("currency_delete");
		$this->view->headTitle($this->view->title);

		if (($id = (int) $this->_getParam('id', 0)) <= 0) {
			$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect('/admin/currency/list');
		}

		$confirm = $this->_getParam('confirm', 0);

		if ($confirm === 'no') {
			$this->_redirect('/admin/currency/list');
		} elseif ($confirm === 'yes') {
			$modelCurrency = new Admin_Model_DbTable_Currency();
			if ($modelCurrency->remove($id))
				$this->_flashMessenger->addMessage(array('success', 1));
			else
				$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect('/admin/currency/list');
		}
	}

	public function updateRatesAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("update_rates");
		$this->view->headTitle($this->view->title);

		$form = new Admin_Form_CurrenciesRates();
		$form->submit->setLabel(Zend_Registry::get('Zend_Translate')->translate('update'));
		$this->view->form = $form;

		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$modelCurrency = new Admin_Model_DbTable_Currency();
				if ($modelCurrency->updateRates($formData))
					$this->_flashMessenger->addMessage(array('success', 1));
				else
					$this->_flashMessenger->addMessage(array('error', 0));
				$this->_redirect('/admin');
			} else {
				$form->populate($formData);
			}
		} else {
			$form->populateFromDb();
		}
	}
}
