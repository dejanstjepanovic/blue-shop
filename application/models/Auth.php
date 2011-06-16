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
class Model_Auth
{
	/**
	 * @param array $formData
	 * @return boolean
	 */
	public function register($formData)
	{
		$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$salt = Zend_Registry::get('config')->password->salt;

		$insertData = array(
			'username'		 => $formData['username'],
			'email'			 => $formData['email'],
			'password'		 => md5($formData['password'] . $salt),
			'status'		 => 'awaiting',
			'role_id'		 => Bs_Controller_AclSetup::ROLE_USER,
			'confirmcode'	 => $this->_makeConfirmCode(),
			'registerdate'	 => date('Y-m-d H:i:s'),
		);

		try {
			$db->insert('users', $insertData);
			$uid = $db->lastInsertId();
		} catch (Zend_Db_Statement_Exception $ex) {
			if ($this->_setFormError($ex->getMessage()))
				return false;
			throw new Exception($ex->getMessage());
		}

		$mailService = new Model_MailService();
		return $mailService->addressVerification($insertData['email'], $insertData['username'], $uid, $insertData['confirmcode']);
	}

	/**
	 * @param number $uid
	 * @param string $code
	 */
	public function verifyAddress($uid, $code)
	{
		$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$bind = array('status' => 'active', 'confirmcode' => '');
		$where = "user_id=" . (int) $uid . " AND status='awaiting' AND confirmcode='$code'";

		try {
			return $db->update('users', $bind, $where);
		} catch (Exception $ex) {
			return false;
		}
	}

	public function resetPassword($email, $code = null)
	{
		$db = Zend_Db_Table_Abstract::getDefaultAdapter();

		if ($code == null) {
			$generatedCode = $this->_makeConfirmCode();
			try {
				$result = $db->update('users',
					array('confirmcode' => $generatedCode),
					"email='$email' AND status='active'"
				);
			} catch (Exception $ex) {
				return false;
			}
			if (!$result)
				return false;
			$mailService = new Model_MailService();
			return $mailService->resetPassword($email, $generatedCode);
		} else {
			$newPass = $this->_makeRandomPass();
			$salt = Zend_Registry::get('config')->password->salt;
			try {
				$result = $db->update('users',
					array('confirmcode' => '', 'password' => md5($newPass . $salt)),
					"email='$email' AND status='active' AND confirmcode='$code'"
				);
			} catch (Exception $ex) {
				return false;
			}
			if (!$result)
				return false;
			$mailService = new Model_MailService();
			return $mailService->sendNewPassword($email, $newPass);
		}
	}

	/**
	 * @param array $formData
	 */
	public function _resetPassword($formData)
	{
		$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$email = $formData['email'];
		$newPass = $this->_makeRandomPass();
		$salt = Zend_Registry::get('config')->password->salt;

		$bind = array('password' => md5($newPass . $salt));
		$where = "email='$email'";

		try {
			$result = $db->update('users', $bind, $where);
			if (!$result)
				return false;
		} catch (Exception $ex) {
			return false;
		}

		$mailService = new Model_MailService();
		return $mailService->resetPassword($email, $insertData['username'], $uid, $insertData['confirmcode']);
	}

	/**
	 * @param array $formData
	 * @return boolean
	 */
	public function login($formData)
	{
		$salt = Zend_Registry::get('config')->password->salt;

		$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table_Abstract::getDefaultAdapter(),
			'users',
			'username',
			'password',
			"MD5(CONCAT(?,'" . $salt . "')) AND status='active'");

		$authAdapter->setIdentity($formData['username'])->setCredential($formData['password']);
		$result = $authAdapter->authenticate();

		Zend_Session::regenerateId();

		if ($result->isValid()) {
			$storage = Zend_Auth::getInstance()->getStorage();
			$storage->write($authAdapter->getResultRowObject(array('username', 'role_id', 'user_id')));
			return true;
		}

		return false;
	}

	/**
	 * just clear identity
	 */
	public static function logout()
	{
		$authAdapter = Zend_Auth::getInstance();
		$authAdapter->clearIdentity();
	}

	/**
	 * @return string
	 */
	protected function _makeConfirmCode()
	{
		return sha1(str_replace('.', '', microtime(true)) . 'opdfj7ad8SCFDA89');
	}

	/**
	 * @param integer $length
	 * @return string
	 */
	protected function _makeRandomPass($length = 10)
	{
		return substr(sha1(str_replace('.', '', microtime(true)) . 'FDzf9opd8SCdfj7a'), 0, $length);
	}

	/**
	 * @param string $msg Zend_Db_Statement_Exception message
	 * @return boolean
	 */
	protected function _setFormError($msg)
	{
		$msg = strtolower($msg);
		if (strpos($msg, 'duplicate entry') !== false) {
			$view = Zend_Registry::get('view');
			if (strpos($msg, 'username') !== false) {
				$view->form->username->addErrors(array('already_in_use'));
				return true;
			}
			if (strpos($msg, 'email') !== false) {
				$view->form->email->addErrors(array('already_in_use'));
				return true;
			}
		}
		return false;
	}
}
