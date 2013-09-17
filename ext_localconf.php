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

?>