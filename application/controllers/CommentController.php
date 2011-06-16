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
class CommentController extends Zend_Controller_Action
{
	/**
	 * @var Zend_Controller_Action_Helper_FlashMessenger
	 */
	protected $_flashMessenger;

	public function init()
	{
		$this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
	}

	public function indexAction()
	{

	}

	public function voteAction()
	{
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();
		
		$redirectUrl = (($pid = (int) $this->_getParam('pid', 0)) > 0) ? '/product/view/id/' . $pid : '/';

		if (($id = (int) $this->_getParam('up', 0)) > 0) {
			$vote = 'up';
		} elseif (($id = (int) $this->_getParam('down', 0)) > 0) {
			$vote = 'down';
		} else {
			$this->_flashMessenger->addMessage(array('error', 0));
			$this->_redirect($redirectUrl);
		}

		$modelComment = new Model_Comments();
		if ($modelComment->isAlreadyVoted($id)) {
			$this->_flashMessenger->addMessage(array('already_voted', 2));
			$this->_redirect($redirectUrl);
		}
		if ($modelComment->vote($id, $vote) !== false) {
			$this->_flashMessenger->addMessage(array('success', 1));
		} else {
			$this->_flashMessenger->addMessage(array('error', 0));
		}
		$this->_redirect($redirectUrl);
	}
}

