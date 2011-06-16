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
class Admin_Form_Slide extends Admin_Form_Base
{
	public function init()
	{
		$this->setName('slide');

		$content = new Zend_Form_Element_Textarea('content');
		$content->setLabel('content')
			->setRequired(true);

		$images = new Zend_Form_Element_Hidden('p_images');
		$images->setLabel('images')
			->removeDecorator('htmlTag');

		$start = new Zend_Form_Element_Text('start');
		$start->setLabel('start')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$end = new Zend_Form_Element_Text('end');
		$end->setLabel('end')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$order = new Zend_Form_Element_Text('order');
		$order->setLabel('order')
			->setRequired(true);

		$group_id = new Zend_Form_Element_Select('group_id');
		$group_id->setLabel('publish')
			->setRequired(true)
			->addMultiOptions(Admin_Model_DbTable_SlideGroup::getList());

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('add')
			->removeDecorator('DtDdWrapper');

		$this->addElements(array($content, $images, $start, $end, $order, $group_id, $submit));
	}
}