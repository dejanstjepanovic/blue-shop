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
class Model_MailService
{
	/**
	 * @var Bs_HtmlMailer
	 */
	protected $_mail;
	
	public function __construct()
	{
		$this->_mail = new Bs_HtmlMailer();
	}
	
	/**
	 * @param string $address
	 * @param string $name
	 */
	public function welcomeMessage($address, $name)
	{
		$subject = Zend_Registry::get('Zend_Translate')->translate("welcome");
		
		$this->_mail->setSubject($subject)
			->addTo($address)
			->setViewParam('name', $name);
			
		return $this->_mail->sendHtmlTemplate("welcome-message.phtml");
	}
	
	/**
	 * @param string $address
	 * @param string $name
	 * @param string $user_id
	 * @param string $code
	 */
	public function addressVerification($address, $name, $user_id, $code)
	{
		$subject = Zend_Registry::get('Zend_Translate')->translate("address_verification_subject");
		$link = Zend_Registry::get('appConfig')->host->name . '/auth/address-verification/uid/' . $user_id . '/code/' . $code;
		$this->_mail->setSubject($subject)
			->addTo($address)
			->setViewParam('name', $name)
			->setViewParam('verificationLink', $link);
			
		return $this->_mail->sendHtmlTemplate("address-verification.phtml");
	}
	
	/**
	 * @param string $address
	 * @param string $code
	 */
	public function resetPassword($address, $code)
	{
		$subject = Zend_Registry::get('Zend_Translate')->translate("password_reset_subject");
		$link = Zend_Registry::get('appConfig')->host->name . '/auth/reset-password/email/' . $address . '/code/' . $code;
		$this->_mail->setSubject($subject)
			->addTo($address)
			->setViewParam('resetPassLink', $link);
			
		return $this->_mail->sendHtmlTemplate("reset-password.phtml");
	}
	
	/**
	 * @param string $address
	 * @param string $name
	 * @param string $user_id
	 * @param string $code
	 */
	public function sendNewPassword($address, $password)
	{
		$subject = Zend_Registry::get('Zend_Translate')->translate("password_reset_subject");
		$this->_mail->setSubject($subject)
			->addTo($address)
			->setViewParam('password', $password);
			
		return $this->_mail->sendHtmlTemplate("send-new-password.phtml");
	}
}

