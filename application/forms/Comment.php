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
class Form_Comment extends Form_Base
{
	public function init()
	{
		$this->setName('comment');
		
		$subject = new Zend_Form_Element_Text('subject');
		$subject->setRequired(true)
			->setLabel('subject')
			->setFilters(array('StringTrim', 'StripTags'))
			->setOrder(1);
		
		$message = new Zend_Form_Element_Textarea('message');
		$message->setRequired(true)
			->setLabel('message')
			->setFilters(array('StringTrim', 'StripTags'))
			->setOrder(5);
			
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setLabel('submit')
			->setOrder(7);
		
		$this->addElements(array($subject, $message, $submit));
		
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->formForGuest();
	}

	public function formForGuest()
	{
		$guest_name = new Zend_Form_Element_Text('guest_name');
		$guest_name->setRequired(true)
			->setLabel('name')
			->setFilters(array('StringTrim', 'StripTags'))
			->setOrder(2);
		
		$guest_mail = new Zend_Form_Element_Text('guest_mail');
		$guest_mail->setRequired(true)
			->setLabel('mail')
			->setFilters(array('StringTrim', 'StripTags'))
			->addValidator('EmailAddress')
			->setOrder(3);
		
		$guest_site = new Zend_Form_Element_Text('guest_site');
		$guest_site->setLabel('site')
			->setFilters(array('StringTrim', 'StripTags'))
			->setOrder(4);
		
		$captcha = new Zend_Form_Element_Captcha('Captcha', array(
				'label'		=>"Please verify you're a human:",
				'captcha'	=>array(
					'captcha'	=>'Figlet',
					'wordLen'	=>6,
					'timeout'	=>300,
				),
				'order'	=> 6
			));
			
		$this->addElements(array($guest_name, $guest_mail, $guest_site, $captcha));
	}
}

