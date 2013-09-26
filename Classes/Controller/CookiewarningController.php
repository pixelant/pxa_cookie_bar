<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package pxa_cookie_bar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_PxaCookieBar_Controller_CookiewarningController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_PxaCookieBar_Domain_Repository_CookiewarningRepository
	 */
	protected $cookiewarningRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->cookiewarningRepository = t3lib_div::makeInstance('Tx_PxaCookieBar_Domain_Repository_CookiewarningRepository');
    }


	/**
	 * action warning
	 *
	 * @return void
	 */
	public function warningAction() {
		if($_COOKIE['pxa_cookie_warning']) {
		   $this->view->assign('show','0');}
		else{
		// unset cookies
		if (isset($_SERVER['HTTP_COOKIE'])) {
		    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		    foreach($cookies as $cookie) {
		        $parts = explode('=', $cookie);
		        $name = trim($parts[0]);
		        setcookie($name, '', time()-1000);
		        setcookie($name, '', time()-1000, '/');
		        setcookie($name, '', time()-1000, '/',substr($_SERVER['SERVER_NAME'],3));
		    }
		}
		
		$this->view->assign('show','1');
		//$mess = $this->cookiewarningRepository->findByUid($this->settings['messUid']);
		$messages = $this->cookiewarningRepository->findSomething();
		$mess = $messages->getFirst();
		if ($mess) {
			$this->view->assign('message',$mess->getWarningmessage());
			$this->view->assign('moretext',$mess->getLinktext());
			$this->view->assign('page',$mess->getPage());
			}
		}
	}

	/**
	 * action closeWarning
	 *
	 * @return void
	 */
	public function closeWarningAction() {
		setcookie('pxa_cookie_warning', 1,time()+60*60*24*30*12,'/');
		return TRUE;
	}

}
?>