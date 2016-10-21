<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pxacookiebar',
	'Cookie warning'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Cookie bar');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pxacookiebar_domain_model_cookiewarning', 'EXT:pxa_cookie_bar/Resources/Private/Language/locallang_csh_tx_pxacookiebar_domain_model_cookiewarning.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pxacookiebar_domain_model_cookiewarning');