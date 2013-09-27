<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pxacookiebar',
	array(
		'Cookiewarning' => 'warning, closeWarning',
		
	),
	// non-cacheable actions
	array(
		'Cookiewarning' => 'warning, closeWarning',
		
	)
);

if (TYPO3_MODE == 'FE') {
	/*
	if($GLOBALS['TYPO3_CONF_VARS']['SYS']['compat_version'] >= 6.0) {
	 		$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Frontend\\Authentication\\FrontendUserAuthentication'] = array(
	       'className' => 'TYPO3\\PxaCookieBar\\Hooks\\FrontendUserAuthentication'
	    );
	} else {
		$TYPO3_CONF_VARS['FE']['XCLASS']['tslib/class.tslib_feuserauth.php'] = t3lib_extMgm::extPath($_EXTKEY, 'Classes/Hooks/class.ux_tslib_feUserAuth.php');
	}
	*/
	$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 'EXT:pxa_cookie_bar/Classes/Hooks/class.tx_pxacookiebar.php:tx_pxacookiebar->contentPostProc_all';  	
	
}
?>