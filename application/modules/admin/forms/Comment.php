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
class Admin_Form_Comment extends Admin_Form_Base
{
	public function init()
	{
		$this->setName('comment');

		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('name')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setOrder(1);

		$mail = new Zend_Form_Element_Text('mail');
		$mail->setLabel('mail')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setOrder(2);

		$site = new Zend_Form_Element_Text('site');
		$site->setLabel('site')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setOrder(3);

		$subject = new Zend_Form_Element_Text('subject');
		$subject->setLabel('subject')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setOrder(4);

		$message = new Zend_Form_Element_Textarea('message');
		$message->setLabel('message')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setOrder(5);

		$publish = new Zend_Form_Element_Select('publish');
		$publish->setLabel('publish')
			->setRequired(true)
			->addMultiOptions(array('yes'=>'Yes', 'no'=>'No'))
			->setOrder(6);

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('edit')
			->removeDecorator('DtDdWrapper')
			->setOrder(7);

		$this->addElements(array($name, $mail, $site, $subject, $message, $publish, $submit));
	}
	
	public function userComment()
	{
		$this->removeElement('name');
		$this->removeElement('mail');
		$this->removeElement('site');
	}
}