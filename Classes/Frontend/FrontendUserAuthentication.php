<?php

namespace TYPO3\PxaCookieBar\Frontend;

class FrontendUserAuthentication extends \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication {
	function __construct() {
		parent::__construct();
		if($_COOKIE['pxa_cookie_warning']) {
			$this->dontSetCookie = FALSE;
		} else {
			$this->dontSetCookie = TRUE;
		}       
   }
}

?>