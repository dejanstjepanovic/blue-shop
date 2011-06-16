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
class Admin_Form_StatSubForm extends Zend_Form
{
	public function init()
	{
		$elementDecorators = array(
			'ViewHelper',
			'Description',
			'Errors',
			array('Label', array('tag' => 'span')),
		);
		$teamsList = array(
			't1' => 'Team1',
			't2' => 'Team2',
			't3' => 'Team3',
			't4' => 'Team4',
		);
		$countryList = array(
			'c1' => 'Country1',
			'c2' => 'Country2',
			'c3' => 'Country3',
			'c4' => 'Country4',
		);
		$leagueList = array(
			'l1' => 'League1',
			'l2' => 'League2',
			'l3' => 'League3',
			'l4' => 'League4',
		);

		$id = new Zend_Form_Element_Hidden('id');
		$id->setAttrib('class', 'stat-subform-id');
		$id->setDecorators(array('ViewHelper'));

		$del = new Zend_Form_Element_Hidden('del');
		$del->setAttrib('class', 'stat-subform-del');
		$del->setValue(0);
		$del->setDecorators(array('ViewHelper'));

		$team = new Zend_Form_Element_Select('team');
		$team->setLabel('Team:')
			->addMultiOptions(array('' => '-- --'))
			->addMultiOptions($teamsList);
		$team->removeDecorator('htmlTag');
		$team->setDecorators($elementDecorators);

		$country = new Zend_Form_Element_Select('country');
		$country->setLabel('Country:')
			->addMultiOptions(array('' => '-- --'))
			->addMultiOptions($countryList);
		$country->removeDecorator('htmlTag');
		$country->setDecorators($elementDecorators);

		$league = new Zend_Form_Element_Select('league');
		$league->setLabel('League:')
			->addMultiOptions(array('' => '-- --'))
			->addMultiOptions($leagueList);
		$league->removeDecorator('htmlTag');
		$league->setDecorators($elementDecorators);

		$ppg = new Zend_Form_Element_Text('ppg');
		$ppg->setLabel('ppg:');
		$ppg->removeDecorator('htmlTag');
		$ppg->setDecorators($elementDecorators);

		$rpg = new Zend_Form_Element_Text('rpg');
		$rpg->setLabel('rpg:');
		$rpg->removeDecorator('htmlTag');
		$rpg->setDecorators($elementDecorators);

		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag' => 'div', 'class' => 'stat-form-row')), 'Form'));
		$this->setIsArray(true);
		$this->removeDecorator('form');

		$this->addElements(array($id, $del, $team, $country, $league, $ppg, $rpg));
	}
}
