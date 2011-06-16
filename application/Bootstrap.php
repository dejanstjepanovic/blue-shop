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
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initRegistry()
	{
		$appConfig = new Zend_Config_Ini(APPLICATION_PATH . '/configs/app_config.ini');
		Zend_Registry::set('appConfig', $appConfig);
		
		$config = new Zend_Config($this->getOptions());
		Zend_Registry::set('config', $config);

		$auth = Zend_Auth::getInstance();
		$identity = $auth->getIdentity();
		Zend_Registry::set('identity', $identity);
		
		$sn = new Zend_Session_Namespace('visitor_data');
		if (!isset($sn->currency))
			$sn->currency = Zend_Registry::get('config')->currency->default;
		Zend_Registry::set('visitor_data', $sn);
		
		$acl = new Bs_Controller_AclSetup();
		Zend_Registry::set('acl', $acl);
	}
	
	protected function _initView()
	{
		$view = new Zend_View();
		$view->headTitle('BlueShop :: ');
		//$view->headTitle()->enableTranslation();
		$view->doctype('XHTML1_TRANSITIONAL');
		$view->headMeta()->appendName('keywords', 'ecommerce, webshop, cms, blueshop, cart')
			->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')
			->appendHttpEquiv('Content-Language', 'en-US');
		$view->addHelperPath(realpath(APPLICATION_PATH . '/../library/Bs/View/Helper'), 'Bs_View_Helper');
		Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer')->setView($view);
		Zend_Registry::set('view', $view);
	}
}

