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
class Bs_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
	/* (non-PHPdoc)
	 * @see Controller/Plugin/Zend_Controller_Plugin_Abstract::routeShutdown()
	 */
	public function routeShutdown(Zend_Controller_Request_Abstract $request)
	{
		$acl = Zend_Registry::get('acl');

		$auth = Zend_Auth::getInstance();

		$role = ($auth->hasIdentity()) ? $auth->getIdentity()->role_id : Bs_Controller_AclSetup::ROLE_GUEST;

		$resource = $request->controller;
		if ($request->module != 'default')
			$resource = $request->module . ":" . $request->controller;

		$privilege = $request->action;

		if (!$acl->isAllowed($role, $resource, $privilege)) {
			if ($role >= Bs_Controller_AclSetup::ROLE_USER) {
				$request->setModuleName('default');
			}

			Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')
				->addMessage(array("You don't have permission to access this page", 0));

			if (strpos(@$_SERVER['HTTP_REFERER'], @$_SERVER['HTTP_HOST']) !== false)
				$ref = $_SERVER['HTTP_REFERER'];
			else
				$ref = '/';

			Zend_Controller_Action_HelperBroker::getStaticHelper('redirector')->gotoURL($ref);
		}
	}
}
