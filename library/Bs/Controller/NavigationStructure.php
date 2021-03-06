<?php
/**
 * @license
 * @version
 * @author mrblue
 */
class Bs_Controller_NavigationStructure
{
	public static $public = array(
		array(
			'label'		 => 'home',
			'class'		 => 'tab',
			'action'	 => 'index',
			'controller' => 'index',
			'privilege'	 => 'index',
			'resource'	 => 'index',
		),
		array(
			'label'		 => 'products',
			'class'		 => 'tab',
			'action'	 => 'index',
			'controller' => 'product',
			'privilege'	 => 'index',
			'resource'	 => 'product',
		),
		array(
			'label'		 => 'categories',
			'class'		 => 'tab',
			'action'	 => 'index',
			'controller' => 'category',
			'privilege'	 => 'index',
			'resource'	 => 'category',
		),
//		array(
//			'label'		 => 'sections',
//			'class'		 => 'tab',
//			'action'	 => 'index',
//			'controller' => 'section',
//			'privilege'	 => 'index',
//			'resource'	 => 'section',
//		),
//		array(
//			'label'		 => 'manufacturers',
//			'class'		 => 'tab',
//			'action'	 => 'index',
//			'controller' => 'manufacturer',
//			'privilege'	 => 'index',
//			'resource'	 => 'manufacturer',
//		),
		array(
			'label'		 => 'search',
			'class'		 => 'tab',
			'action'	 => 'index',
			'controller' => 'search',
			'privilege'	 => 'index',
			'resource'	 => 'search',
		),
		array(
			'label'		 => 'login',
			'class'		 => 'tab',
			'action'	 => 'login',
			'controller' => 'auth',
			'privilege'	 => 'login',
			'resource'	 => 'auth',
		),
		array(
			'label'		 => 'logout',
			'class'		 => 'tab',
			'action'	 => 'logout',
			'controller' => 'auth',
			'privilege'	 => 'logout',
			'resource'	 => 'auth',
		),
		array(
			'label'		 => 'register',
			'class'		 => 'tab',
			'action'	 => 'register',
			'controller' => 'auth',
			'privilege'	 => 'register',
			'resource'	 => 'auth',
		),
		array(
			'label'		 => 'contact',
			'class'		 => 'tab',
			'action'	 => 'index',
			'controller' => 'contact',
			'resource'	 => 'contact',
		),
		array(
			'label'		 => 'about_us',
			'class'		 => 'tab',
			'action'	 => 'index',
			'controller' => 'about-us',
			'privilege'	 => 'index',
			'resource'	 => 'about-us',
		),
		array(
			'label'		 => 'admin',
			'class'		 => 'tab',
			'action'	 => 'index',
			'controller' => 'index',
			'module'	 => 'admin',
			'privilege'	 => 'index',
			'resource'	 => 'admin:index',
		),
	);

	public static $admin = array(
		array(
			'label'		 => 'home',
			'class'		 => 'tab',
			'action'	 => 'index',
			'controller' => 'index',
			'module'	 => 'admin',
			'privilege'	 => 'index',
			'resource'	 => 'admin:index',
		),
		array(
			'label'		 => 'products',
			'class'		 => 'tab',
			'action'	 => 'list',
			'controller' => 'product',
			'module'	 => 'admin',
			'privilege'	 => 'list',
			'resource'	 => 'admin:product',
			'pages'		 => array(
				array(
					'label'		 => 'product_add',
					'class'		 => 'child',
					'action'	 => 'add',
					'controller' => 'product',
					'module'	 => 'admin',
					'privilege'	 => 'add',
					'resource'	 => 'admin:product',
				),
				array(
					'label'		 => 'products_list',
					'class'		 => 'child',
					'action'	 => 'list',
					'controller' => 'product',
					'module'	 => 'admin',
					'privilege'	 => 'list',
					'resource'	 => 'admin:product',
				),
				array(
					'label'		 => 'product_featured_list',
					'class'		 => 'child',
					'action'	 => 'list',
					'controller' => 'featured',
					'module'	 => 'admin',
					'privilege'	 => 'list',
					'resource'	 => 'admin:featured',
				),
			),
		),
		array(
			'label'		 => 'categories',
			'class'		 => 'tab',
			'action'	 => 'list',
			'controller' => 'category',
			'module'	 => 'admin',
			'privilege'	 => 'list',
			'resource'	 => 'admin:category',
			'pages'		 => array(
				array(
					'label'		 => 'category_add',
					'class'		 => 'child',
					'action'	 => 'add',
					'controller' => 'category',
					'module'	 => 'admin',
					'privilege'	 => 'add',
					'resource'	 => 'admin:category',
				),
				array(
					'label'		 => 'categories_list',
					'class'		 => 'child',
					'action'	 => 'list',
					'controller' => 'category',
					'module'	 => 'admin',
					'privilege'	 => 'list',
					'resource'	 => 'admin:category',
				),
			),
		),
		array(
			'label'		 => 'sections',
			'class'		 => 'tab',
			'action'	 => 'list',
			'controller' => 'section',
			'module'	 => 'admin',
			'privilege'	 => 'list',
			'resource'	 => 'admin:section',
			'pages'		 => array(
				array(
					'label'		 => 'section_add',
					'class'		 => 'child',
					'action'	 => 'add',
					'controller' => 'section',
					'module'	 => 'admin',
					'privilege'	 => 'add',
					'resource'	 => 'admin:section',
				),
				array(
					'label'		 => 'sections_list',
					'class'		 => 'child',
					'action'	 => 'list',
					'controller' => 'section',
					'module'	 => 'admin',
					'privilege'	 => 'list',
					'resource'	 => 'admin:section',
				),
			),
		),
		array(
			'label'		 => 'manufacturers',
			'class'		 => 'tab',
			'action'	 => 'list',
			'controller' => 'manufacturer',
			'module'	 => 'admin',
			'privilege'	 => 'list',
			'resource'	 => 'admin:manufacturer',
			'pages'		 => array(
				array(
					'label'		 => 'manufacturer_add',
					'class'		 => 'child',
					'action'	 => 'add',
					'controller' => 'manufacturer',
					'module'	 => 'admin',
					'privilege'	 => 'add',
					'resource'	 => 'admin:manufacturer',
				),
				array(
					'label'		 => 'manufacturers_list',
					'class'		 => 'child',
					'action'	 => 'list',
					'controller' => 'manufacturer',
					'module'	 => 'admin',
					'privilege'	 => 'list',
					'resource'	 => 'admin:manufacturer',
				),
			),
		),
		array(
			'label'		 => 'comments',
			'class'		 => 'tab',
			'action'	 => 'list',
			'controller' => 'comment',
			'module'	 => 'admin',
			'privilege'	 => 'list',
			'resource'	 => 'admin:comment',
		),
		array(
			'label'		 => 'slides',
			'class'		 => 'tab',
			'action'	 => 'list',
			'controller' => 'slide',
			'module'	 => 'admin',
			'privilege'	 => 'list',
			'resource'	 => 'admin:slide',
			'pages'		 => array(
				array(
					'label'		 => 'slide_add',
					'class'		 => 'child',
					'action'	 => 'add',
					'controller' => 'slide',
					'module'	 => 'admin',
					'privilege'	 => 'add',
					'resource'	 => 'admin:slide',
				),
				array(
					'label'		 => 'slide_list',
					'class'		 => 'child',
					'action'	 => 'list',
					'controller' => 'slide',
					'module'	 => 'admin',
					'privilege'	 => 'list',
					'resource'	 => 'admin:slide',
				),
//				array(
//					'label'		 => 'slide_group_add',
//					'class'		 => 'child',
//					'action'	 => 'add',
//					'controller' => 'slide-group',
//					'module'	 => 'admin',
//					'privilege'	 => 'add',
//					'resource'	 => 'admin:slide-group',
//				),
				array(
					'label'		 => 'slide_groups_list',
					'class'		 => 'child',
					'action'	 => 'list',
					'controller' => 'slide-group',
					'module'	 => 'admin',
					'privilege'	 => 'list',
					'resource'	 => 'admin:slide-group',
				),
			),
		),
		array(
			'label'		 => 'currency',
			'class'		 => 'tab',
			'action'	 => 'list',
			'controller' => 'currency',
			'module'	 => 'admin',
			'privilege'	 => 'list',
			'resource'	 => 'admin:currency',
			'pages'		 => array(
				array(
					'label'		 => 'currency_add',
					'class'		 => 'child',
					'action'	 => 'add',
					'controller' => 'currency',
					'module'	 => 'admin',
					'privilege'	 => 'add',
					'resource'	 => 'admin:currency',
				),
				array(
					'label'		 => 'currency_list',
					'class'		 => 'child',
					'action'	 => 'list',
					'controller' => 'currency',
					'module'	 => 'admin',
					'privilege'	 => 'list',
					'resource'	 => 'admin:currency',
				),
				array(
					'label'		 => 'update_rates',
					'class'		 => 'child',
					'action'	 => 'update-rates',
					'controller' => 'currency',
					'module'	 => 'admin',
					'privilege'	 => 'update-rates',
					'resource'	 => 'admin:currency',
				),
			),
		),
		array(
			'label'		 => 'logout',
			'class'		 => 'tab',
			'action'	 => 'logout',
			'controller' => 'auth',
			'privilege'	 => 'logout',
			'resource'	 => 'auth',
		),
		array(
			'label'		 => 'public',
			'class'		 => 'tab',
			'action'	 => 'index',
			'controller' => 'index',
			'privilege'	 => 'index',
			'resource'	 => 'index',
		),
	);
}
