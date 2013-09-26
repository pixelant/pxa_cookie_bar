<?php

class ux_tslib_feUserAuth extends tslib_feUserAuth {
	function __construct() {
		if(!isset($_COOKIE['pxa_cookie_warning'])) {
			$this->dontSetCookie = TRUE;
		} else {
			$this->dontSetCookie = FALSE;
		}
	} 
}
if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pxa_cookie_bar/Classes/UserAuth/class.ux_tslib_feUserAuth.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/pxa_cookie_bar/Classes/UserAuth/class.ux_tslib_feUserAuth.php']);
}
?>