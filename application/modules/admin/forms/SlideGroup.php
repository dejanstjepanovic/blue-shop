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
class Admin_Form_SlideGroup extends Admin_Form_Base
{
	public function init()
	{
		$this->setName('slide_groups');

		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('name')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$animPause = new Zend_Form_Element_Text('animPause');
		$animPause->setLabel('animPause')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$animDur = new Zend_Form_Element_Text('animDur');
		$animDur->setLabel('animDur')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim');

		$animTypeI = new Zend_Form_Element_Select('animTypeI');
		$animTypeI->setLabel('animTypeI')
			->setRequired(true)
			->addMultiOptions(array(
				'h'	 => 'Scroll',
				'f'	 => 'Fade',
		));

		$animTypeD = new Zend_Form_Element_Select('animTypeD');
		$animTypeD->setLabel('animTypeD')
			->setRequired(true)
			->addMultiOptions(array(
				'h'	 => 'Scroll',
				'f'	 => 'Fade',
		));

		$enabled = new Zend_Form_Element_Select('enabled');
		$enabled->setLabel('enabled')
			->setRequired(true)
			->addMultiOptions(array(
				'1'	 => 'Yes',
				'0'	 => 'No',
		));

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('edit')
			->removeDecorator('DtDdWrapper');

		$this->addElements(array($name, $animPause, $animDur, $animTypeI, $animTypeD, $enabled, $submit));
	}
}
