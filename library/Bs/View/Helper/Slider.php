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
class Bs_View_Helper_Slider
{
	/**
	 * @var Zend_View
	 */
	protected $_view;
	
	/**
	 * @param integer $group_id
	 * @return string
	 */
	public function slider($group_id)
	{
		$this->_view = new Zend_View();
		$this->_view->setScriptPath(APPLICATION_PATH . '/views/scripts/_slider-templates');
		
		switch ($group_id) {
		case 5:
			$html = $this->headlines();
			break;
		case 6:
			$html = $this->topslider();
			break;
		case 7:
			$html = $this->bigslider();
			break;
		default:
			$html = '';
			break;
		}
		
		return $html;
	}

	protected function headlines()
	{
		$slides = Model_Slider::getSlides(5);
		if (empty($slides[0]))
			return '';
		$this->_view->slides = $slides;
		return $this->_view->render('_head-lines.phtml');
	}

	protected function topslider()
	{
		$slides = Model_Slider::getSlides(6);
		if (empty($slides[0]))
			return '';
		$this->_view->slides = $slides;
		return $this->_view->render('_top-slider.phtml');
	}
	
	protected function bigslider()
	{
		$request = Zend_Controller_Front::getInstance()->getRequest();
		if ($request->controller != 'index' OR $request->action != 'index')
			return '';
		$slides = Model_Slider::getSlides(7);
		if (empty($slides[0]))
			return '';
		$this->_view->slides = $slides;
		return $this->_view->render('_big-slider.phtml');
	}
}
