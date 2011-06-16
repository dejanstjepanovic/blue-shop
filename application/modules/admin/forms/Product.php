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
class Admin_Form_Product extends Admin_Form_Base
{
	public function init()
	{
		$this->setName('product');

		$name = new Zend_Form_Element_Text('p_name');
		$name->setLabel('name')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$description = new Zend_Form_Element_Textarea('p_description');
		$description->setLabel('description')
			->setRequired(true);

		$specification = new Zend_Form_Element_Textarea('p_spec');
		$specification->setLabel('specification');

		$images = new Zend_Form_Element_Hidden('p_images');
		$images->setLabel('images')
			->removeDecorator('htmlTag');

		$price = new Zend_Form_Element_Text('p_price');
		$price->setLabel('price')
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$stock = new Zend_Form_Element_Text('p_stock');
		$stock->setLabel('stock')
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$code = new Zend_Form_Element_Text('p_code');
		$code->setLabel('code')
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$tags = new Zend_Form_Element_Text('p_tags');
		$tags->setLabel('tags')
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$publish = new Zend_Form_Element_Select('p_publish');
		$publish->setLabel('publish')
			->setRequired(true)
			->addMultiOptions(array(
				'yes'	 => 'Yes',
				'no'	 => 'No'
		));

		$category_id = new Zend_Form_Element_Select('cat_id');
		$category_id->setLabel('category')
			->setRequired(true)
			->addMultiOptions(array('' => '-- --'))
			->addMultiOptions(Admin_Model_DbTable_Category::getList());

		$manufacturer_id = new Zend_Form_Element_Select('man_id');
		$manufacturer_id->setLabel('manufacturer')
			->setRequired(true)
			->addMultiOptions(array('' => '-- --'))
			->addMultiOptions(Admin_Model_DbTable_Manufacturer::getList());

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('add')
			->removeDecorator('DtDdWrapper');

		$this->addElements(array($name, $description, $specification, $images, $price, $stock, $code,
			$tags, $publish, $category_id, $manufacturer_id, $submit));
	}
}
