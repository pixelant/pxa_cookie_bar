<?php

namespace TYPO3\PxaCookieBar\Hooks;

class FrontendUserAuthentication extends \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication {
	function __construct() {
		parent::__construct();
		
		if(isset($_COOKIE['pxa_cookie_warning'])) {
			$this->dontSetCookie = FALSE;
		} else {
			$this->dontSetCookie = TRUE;
		}    
   }
}

?>