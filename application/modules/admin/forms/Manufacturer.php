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
class Admin_Form_Manufacturer extends Admin_Form_Base
{
	public function init()
	{
		$this->setName('manufacturer');

		$name = new Zend_Form_Element_Text('man_name');
		$name->setLabel('name')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$description = new Zend_Form_Element_Textarea('man_description');
		$description->setLabel('description')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$code = new Zend_Form_Element_Text('man_code');
		$code->setLabel('code')
			//->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$tags = new Zend_Form_Element_Text('man_tags');
		$tags->setLabel('tags')
			//->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$publish = new Zend_Form_Element_Select('man_publish');
		$publish->setLabel('publish')
			->setRequired(true)
			->addMultiOptions(array(
				'yes'	=>'Yes',
				'no'	=>'No'
		));

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('add')
			->removeDecorator('DtDdWrapper');

		$this->addElements(array($name, $description, $code, $tags, $publish, $submit));
	}
}