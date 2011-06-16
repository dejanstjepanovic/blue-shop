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
class Bs_Controller_Plugin_MainManu extends Zend_Controller_Plugin_Abstract
{
	/* (non-PHPdoc)
	 * @see Controller/Plugin/Zend_Controller_Plugin_Abstract::preDispatch()
	 */
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$auth = Zend_Auth::getInstance();
		$role = ($auth->hasIdentity()) ? $auth->getIdentity()->role_id : Bs_Controller_AclSetup::ROLE_GUEST;

		if ($request->module == 'admin' AND $role < Bs_Controller_AclSetup::ROLE_USER)
			$navArr = Bs_Controller_NavigationStructure::$admin;
		else
			$navArr = Bs_Controller_NavigationStructure::$public;

		foreach ($navArr AS & $tab) {
			$navModule = (isset($tab['module'])) ? $tab['module'] : 'default';
			if ($tab['controller'] == $request->controller && $navModule == $request->module)
				$tab['active'] = true;
		}

		$view = Zend_Registry::get('view');

		$navigation = new Zend_Navigation($navArr);
		$view->navigation($navigation)
			->setAcl(new Bs_Controller_AclSetup())
			->setRole($role);
	}
}

