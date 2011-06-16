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
class Bs_Controller_AclSetup extends Zend_Acl
{
	const ROLE_GUEST 			= '5';
	const ROLE_USER 			= '4';
	const ROLE_EDITOR 			= '3';
	const ROLE_ADMIN 			= '2';
	const ROLE_MASTER_ADMIN 	= '1';

	const RES_ERRORS 				= 'errors';
	const RES_INDEX 				= 'index';
	const RES_AUTH 					= 'auth';
	const RES_SEARCH 				= 'search';
	const RES_PRODUCT 				= 'product';
	const RES_CATEGORY 				= 'category';
	const RES_SECTION 				= 'section';
	const RES_MANUFACTURER 			= 'manufacturer';
	const RES_COMMENT 				= 'comment';
	const RES_CART 					= 'cart';
	const RES_CURRENCY 				= 'currency';
	const RES_CONTACT 				= 'contact';
	const RES_ABOUT_US 				= 'about-us';
	
	const RES_ADMIN_INDEX 			= 'admin:index';
	const RES_ADMIN_PRODUCT 		= 'admin:product';
	const RES_ADMIN_CATEGORY 		= 'admin:category';
	const RES_ADMIN_SECTION 		= 'admin:section';
	const RES_ADMIN_MANUFACTURER 	= 'admin:manufacturer';
	const RES_ADMIN_FEATURED 		= 'admin:featured';
	const RES_ADMIN_USER 			= 'admin:user';
	const RES_ADMIN_COMMENT 		= 'admin:comment';
	const RES_ADMIN_CONTACT 		= 'admin:contact';
	const RES_ADMIN_CURRENCY 		= 'admin:currency';
	const RES_ADMIN_SLIDE 			= 'admin:slide';
	const RES_ADMIN_SLIDE_GROUP 	= 'admin:slide-group';
	const RES_ADMIN_OPTIONS 		= 'admin:options';
	const RES_ADMIN_SEARCH 			= 'admin:search';
	const RES_ADMIN_GALLERY 		= 'admin:gallery';
	const RES_ADMIN_EL_FINDER 		= 'admin:el-finder';
	
	const PRIVILEGE_INDEX 				= 'index';
	const PRIVILEGE_REGISTER 			= 'register';
	const PRIVILEGE_ADDRESS_VERIFICATION= 'address-verification';
	const PRIVILEGE_LOGIN 				= 'login';
	const PRIVILEGE_LOGOUT 				= 'logout';
	const PRIVILEGE_RESET_PASSWORD 		= 'reset-password';
	const PRIVILEGE_ADD 				= 'add';
	const PRIVILEGE_LIST 				= 'list';
	const PRIVILEGE_PREVIEW 			= 'preview';
	const PRIVILEGE_EDIT 				= 'edit';
	const PRIVILEGE_CHANGE 				= 'change';
	const PRIVILEGE_DELETE 				= 'delete';
	const PRIVILEGE_REMOVE 				= 'remove';
	const PRIVILEGE_EMPTY 				= 'empty';
	const PRIVILEGE_PUBLISH 			= 'publish';
	const PRIVILEGE_VOTE 				= 'vote';
	const PRIVILEGE_PRODUCT_IMAGES		= 'product-images';
	const PRIVILEGE_CHANGE_CURRENCY		= 'change-currency';
	const PRIVILEGE_UPDATE_RATES		= 'update-rates';
	
	public function __construct()
	{
		// add the System Roles
		$this->addRole(new Zend_Acl_Role(self::ROLE_GUEST));
		$this->addRole(new Zend_Acl_Role(self::ROLE_USER), self::ROLE_GUEST);
		$this->addRole(new Zend_Acl_Role(self::ROLE_EDITOR), self::ROLE_USER);
		$this->addRole(new Zend_Acl_Role(self::ROLE_ADMIN), self::ROLE_EDITOR);
		$this->addRole(new Zend_Acl_Role(self::ROLE_MASTER_ADMIN), self::ROLE_ADMIN);
	
		// add the resources
		$this->addResource(new Zend_Acl_Resource(self::RES_ERRORS));
		$this->addResource(new Zend_Acl_Resource(self::RES_INDEX));
		$this->addResource(new Zend_Acl_Resource(self::RES_AUTH));
		$this->addResource(new Zend_Acl_Resource(self::RES_SEARCH));
		$this->addResource(new Zend_Acl_Resource(self::RES_PRODUCT));
		$this->addResource(new Zend_Acl_Resource(self::RES_CATEGORY));
		$this->addResource(new Zend_Acl_Resource(self::RES_SECTION));
		$this->addResource(new Zend_Acl_Resource(self::RES_MANUFACTURER));
		$this->addResource(new Zend_Acl_Resource(self::RES_COMMENT));
		$this->addResource(new Zend_Acl_Resource(self::RES_CART));
		$this->addResource(new Zend_Acl_Resource(self::RES_CURRENCY));
		$this->addResource(new Zend_Acl_Resource(self::RES_CONTACT));
		$this->addResource(new Zend_Acl_Resource(self::RES_ABOUT_US));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_INDEX));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_PRODUCT));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_CATEGORY));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_SECTION));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_MANUFACTURER));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_FEATURED));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_USER));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_COMMENT));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_CONTACT));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_CURRENCY));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_SLIDE));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_SLIDE_GROUP));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_OPTIONS));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_SEARCH));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_GALLERY));
		$this->addResource(new Zend_Acl_Resource(self::RES_ADMIN_EL_FINDER));

			
		// Master Admin have ALL THE PRIVILEGES ON THE SYSTEM
		$this->allow(self::ROLE_MASTER_ADMIN, NULL);
		
		//Guest privileges
		$this->allow(self::ROLE_GUEST, self::RES_INDEX, NULL);
		$this->allow(self::ROLE_GUEST, self::RES_AUTH, array(self::PRIVILEGE_REGISTER, self::PRIVILEGE_ADDRESS_VERIFICATION, self::PRIVILEGE_LOGIN, self::PRIVILEGE_RESET_PASSWORD));
		$this->allow(self::ROLE_GUEST, self::RES_CURRENCY, NULL);
		$this->allow(self::ROLE_GUEST, self::RES_CONTACT, NULL);
		$this->allow(self::ROLE_GUEST, self::RES_ABOUT_US, NULL);
		$this->allow(self::ROLE_GUEST, self::RES_SEARCH, NULL);
		$this->allow(self::ROLE_GUEST, self::RES_PRODUCT, NULL);
		$this->allow(self::ROLE_GUEST, self::RES_CATEGORY, NULL);
		$this->allow(self::ROLE_GUEST, self::RES_SECTION, NULL);
		$this->allow(self::ROLE_GUEST, self::RES_MANUFACTURER, NULL);
		$this->allow(self::ROLE_GUEST, self::RES_COMMENT, NULL);
		
		//User privileges
		$this->allow(self::ROLE_USER, self::RES_INDEX, NULL);
		$this->allow(self::ROLE_USER, self::RES_AUTH, NULL);
		$this->deny (self::ROLE_USER, self::RES_AUTH, array(self::PRIVILEGE_REGISTER, self::PRIVILEGE_ADDRESS_VERIFICATION, self::PRIVILEGE_LOGIN, self::PRIVILEGE_RESET_PASSWORD));
		$this->allow(self::ROLE_USER, self::RES_CART, NULL);
		
		//Editor privileges
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_INDEX, NULL);
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_SEARCH, NULL);
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_PRODUCT, NULL);
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_FEATURED, NULL);
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_COMMENT, NULL);
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_SLIDE, NULL);
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_SLIDE_GROUP, array(self::PRIVILEGE_INDEX, self::PRIVILEGE_LIST, self::PRIVILEGE_EDIT));
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_GALLERY, NULL);
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_CURRENCY, NULL);
		$this->allow(self::ROLE_EDITOR, self::RES_ADMIN_EL_FINDER, NULL);
		
		//Admin privileges
		$this->allow(self::ROLE_ADMIN, self::RES_ADMIN_CATEGORY, NULL);
		$this->allow(self::ROLE_ADMIN, self::RES_ADMIN_SECTION, NULL);
		$this->allow(self::ROLE_ADMIN, self::RES_ADMIN_MANUFACTURER, NULL);
		$this->allow(self::ROLE_ADMIN, self::RES_ADMIN_USER, NULL);
	}
}
