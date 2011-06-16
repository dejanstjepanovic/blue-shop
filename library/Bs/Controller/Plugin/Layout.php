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
class Bs_Controller_Plugin_Layout extends Zend_Controller_Plugin_Abstract
{
	/* (non-PHPdoc)
	 * @see Controller/Plugin/Zend_Controller_Plugin_Abstract::routeShutdown()
	 */
	public function routeShutdown(Zend_Controller_Request_Abstract $request)
	{
		$layout = Zend_Layout::getMvcInstance();

		$module = strtolower($request->getModuleName());
		$controller = strtolower($request->getControllerName());
		$action = strtolower($request->getActionName());

		if ($module != 'default') {
			$layout->setLayoutPath(APPLICATION_PATH . '/modules/' . $module . '/layouts/scripts/')
				->setLayout($module);
		}
	}
}
