<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Pixelant.' . $_EXTKEY,
	'Pxacookiebar',
	array(
		'Cookiewarning' => 'warning, closeWarning',
		
	),
	// non-cacheable actions
	array(
		'Cookiewarning' => 'warning, closeWarning',
		
	)
);

if (TYPO3_MODE === 'FE') {
	$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 'Pixelant\PxaCookieBar\Hooks\PxaCookieBarHook->contentPostProc_all';
}
