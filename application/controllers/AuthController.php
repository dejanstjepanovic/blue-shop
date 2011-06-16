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
class AuthController extends Zend_Controller_Action
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

	public function registerAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("register");
		$this->view->headTitle($this->view->title);

		$form = new Form_Register();
		$this->view->form = $form;

		$form->populate(array(
			'username'			 => 'username1',
			'email'				 => 'spiderspirit7@gmail.com',
			'password'			 => '123456',
			'password_confirm'	 => '123456',
		));

		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$modelAuth = new Model_Auth();
				if ($modelAuth->register($form->getValues())) {
					$this->_flashMessenger->addMessage(array('registration_successful', 1));
					$this->_redirect('/');
				}
			}
			$form->populate($formData);
		}
	}

	public function addressVerificationAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();

		$uid = preg_replace("/[^0-9]/", '', $this->_request->getParam('uid', ''));
		$code = preg_replace("/[^A-Za-z0-9]/", '', $this->_request->getParam('code', ''));

		if ($uid == '' AND $code == '') {
			$this->_flashMessenger->addMessage(array('error', 0));
		} else {
			$modelAuth = new Model_Auth();
			if ($modelAuth->verifyAddress($uid, $code))
				$this->_flashMessenger->addMessage(array('success', 1));
			else
				$this->_flashMessenger->addMessage(array('error', 0));
		}
		$this->_redirect('/');
	}

	public function loginAction()
	{
		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("login");
		$this->view->headTitle($this->view->title);

		$form = new Form_Login();
		$this->view->form = $form;

		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$modelAuth = new Model_Auth();
				if ($modelAuth->login($form->getValues())) {
					$this->_flashMessenger->addMessage(array('login_successful', 1));
					$this->_redirect('/');
				}
			}
			$form->populate($formData);
		}
	}

	public function logoutAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();
		Model_Auth::logout();
		$this->_redirect('/');
	}

	public function resetPasswordAction()
	{
		$email = $this->_request->getParam('email', '');
		$code = preg_replace("/[^A-Za-z0-9]/", '', $this->_request->getParam('code', ''));

		if ($email != '' AND $code != '') {
			$validator = new Zend_Validate_EmailAddress();
			if (!$validator->isValid($email)) {
				$this->_flashMessenger->addMessage(array('error', 0));
				$this->_redirect('/');
			}
			$this->_helper->viewRenderer->setNoRender();
			$this->_helper->layout()->disableLayout();
			$modelAuth = new Model_Auth();
			if ($modelAuth->resetPassword($email, $code))
				$this->_flashMessenger->addMessage(array('success', 1));
			else
				$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect('/');
		}

		$this->view->title = Zend_Registry::get('Zend_Translate')->translate("reset_password");
		$this->view->headTitle($this->view->title);

		$form = new Form_ResetPassword();
		$this->view->form = $form;

		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$modelAuth = new Model_Auth();
				if ($modelAuth->resetPassword($form->getValue('email')))
					$this->_flashMessenger->addMessage(array('mail_was_sent', 1));
				else
					$this->_flashMessenger->addMessage(array('error', 0));
				$this->_redirect('/');
			}
			$form->populate($formData);
		}
	}

}

