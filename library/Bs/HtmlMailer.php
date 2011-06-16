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
class Bs_HtmlMailer extends Zend_Mail
{
	/**
	 * @var Zend_View
	 */
	static $_defaultView;

	/**
	 * current instance of our Zend_View
	 * @var Zend_View
	 */
	protected $_view;

	/**
	 * @var Zend_Mail_Transport_Smtp
	 */
	protected $_transport;

	/**
	 * @param string $fromEmail Default null
	 * @param string $fromName Default null
	 */
	public function __construct($fromEmail = null, $fromName = null)
	{
		$email = Zend_Registry::get('appConfig')->email;

		if (!$fromEmail)
			$fromEmail = $email->sender->address;
		if (!$fromName)
			$fromName = $email->sender->title;

		$this->_transport = new Zend_Mail_Transport_Smtp($email->server,
			array(
			'ssl'		 => $email->protocol,
			'username'	 => $email->username,
			'password'	 => $email->password,
			'port'		 => $email->port,
			'auth'		 => 'login',
		));

		parent::__construct('utf-8');

		$this->setFrom($fromEmail, $fromName);
		$this->_view = self::_getDefaultView();
	}

	/**
	 * @param string $template name of .phtml file
	 * @param string $encoding
	 */
	public function sendHtmlTemplate($template, $encoding = Zend_Mime::ENCODING_QUOTEDPRINTABLE)
	{
		$html = $this->_view->render($template);
		$this->setBodyHtml($html, $this->getCharset(), $encoding);
		try {
			$this->send($this->_transport);
			return true;
		} catch (Exception $ex) {
			// FIXME log error
			return false;
		}
	}

	/**
	 * @param string $property
	 * @param mixed $value
	 * @return Bs_HtmlMailer
	 */
	public function setViewParam($property, $value)
	{
		$this->_view->$property = $value;
		return $this;
	}

	/**
	 * @return Zend_View
	 */
	protected static function _getDefaultView()
	{
		if (self::$_defaultView === null) {
			self::$_defaultView = new Zend_View();
			self::$_defaultView->setScriptPath(APPLICATION_PATH . '/views/scripts/_mail-templates');
		}
		return self::$_defaultView;
	}
}
