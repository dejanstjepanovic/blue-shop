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
class Model_Comments extends Zend_Db_Table_Abstract
{
	protected $_name = 'comments';
	
	const COOKIE_NAME = 'commVote';
	
	const COOKIE_VALUE_DELIMITED = '_';

	/**
	 * @param integer $id
	 * @param array $data
	 * @return null|boolean
	 */
	public function addComment($id, $data)
	{
		$insertData = array(
			'p_id'		 => $id,
			'subject'	 => $data['subject'],
			'message'	 => $data['message'],
			'created'	 => date('Y-m-d H:i:s')
		);

		if (Zend_Auth::getInstance()->hasIdentity()) {
			$insertData['user_id'] = Zend_Auth::getInstance()->getIdentity()->user_id;
		} else {
			$insertData['name'] = $data['guest_name'];
			$insertData['mail'] = $data['guest_mail'];
			if (!empty($data['site']))
				$insertData['guest_site'] = $data['guest_site'];
		}
		
		try {
			return $this->insert($insertData);
			return true;
		} catch (Zend_Db_Statement_Exception $ex) {
			// TODO log error
			return false;
		}
	}

	public function isAlreadyVoted($id)
	{
		if (isset($_COOKIE[self::COOKIE_NAME])) {
			$data = explode(self::COOKIE_VALUE_DELIMITED, $_COOKIE[self::COOKIE_NAME]);
			if (in_array($id, $data))
				return true;
		}
		$sn = new Zend_Session_Namespace(self::COOKIE_NAME);
		if (is_array($sn->id) AND in_array($id, $sn->id)) {
			$this->_rememberVote($id);
			return true;
		}

		return false;
	}

	public function vote($id, $vote)
	{
		if ($vote == 'up') {
			$field = 'vote_up';
		} elseif ($vote == 'down') {
			$field = 'vote_down';
		} else {
			return false;
		}

		try {
			$this->update(array($field => new Zend_Db_Expr("$field+1")), 'id=' . (int) $id);
			$this->_rememberVote($id);
			return true;
		} catch (Zend_Db_Statement_Exception $ex) {
			// TODO log error
			return false;
		}
	}

	/**
	 * @param integer $id
	 * @param array $param
	 * @return Zend_Paginator
	 */
	public static function getPaginator($id, $param = array())
	{
		$current = (isset($param['page'])) ? (int) $param['page'] : 1;
		$count = (isset($param['count'])) ? (int) $param['count'] : 10;

		$select = self::getDefaultAdapter()
			->select()
			->from('comments')
			->joinLeft('users', 'comments.user_id=users.user_id', array('username'))
			->where('comments.p_id = ?', (int) $id)
			->where('comments.publish="yes"')
			->order('created desc');

		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($select));

		$paginator->setItemCountPerPage($count)
			->setCurrentPageNumber($current);

		return $paginator;
	}

	protected function _rememberVote($id)
	{
		$data = (isset($_COOKIE[self::COOKIE_NAME])) ? $_COOKIE[self::COOKIE_NAME] . self::COOKIE_VALUE_DELIMITED : '';
		$data .= "$id";
		setcookie(self::COOKIE_NAME, $data, null, '/');
		$sn = new Zend_Session_Namespace(self::COOKIE_NAME);
		$sn->id[] = $id;
	}
}

