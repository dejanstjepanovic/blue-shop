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
class Bs_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract
{
	/**
	 * @param string $nameSpace
	 */
	public function flashMessenger($nameSpace = 'default')
	{
		$fm = new Zend_Controller_Action_Helper_FlashMessenger;
		$fm->setNamespace($nameSpace);

		if (!($msgs = $fm->getMessages()))
			return '';

		$out = '<div class="flash-messenger-' . $nameSpace . '">';
		foreach ($msgs AS $msg) {
			if (is_array($msg)) {
				$m = Zend_Registry::get('Zend_Translate')->translate($msg[0]);
				$out .= '<div class="fm-msg l' . $msg[1] . '">' . $m . '</div>';
			} elseif (is_string($msg)) {
				$m = Zend_Registry::get('Zend_Translate')->translate($msg);
				$out .= '<div class="fm-msg">' . $m . '</div>';
			}
		}
		$out .= '</div>';

		return $out;
	}
}
