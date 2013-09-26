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
		if($GLOBALS['TYPO3_CONF_VARS']['SYS']['compat_version'] >= 6.0) {
  			$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Frontend\\Authentication\\FrontendUserAuthentication'] = array(
       'className' => 'TYPO3\\PxaCookieBar\\Frontend\\FrontendUserAuthentication'
       );
  	} else {
  		$TYPO3_CONF_VARS['FE']['XCLASS']['tslib/class.tslib_feuserauth.php'] = t3lib_extMgm::extPath($_EXTKEY, 'Classes/UserAuth/class.ux_tslib_feUserAuth.php');
  	}
}
?>