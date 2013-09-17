<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pxacookiebar',
	'Cookie bar'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Cookie bar');

t3lib_extMgm::addLLrefForTCAdescr('tx_pxacookiebar_domain_model_cookiewarning', 'EXT:pxa_cookie_bar/Resources/Private/Language/locallang_csh_tx_pxacookiebar_domain_model_cookiewarning.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_pxacookiebar_domain_model_cookiewarning');
$TCA['tx_pxacookiebar_domain_model_cookiewarning'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:pxa_cookie_bar/Resources/Private/Language/locallang_db.xml:tx_pxacookiebar_domain_model_cookiewarning',
		'label' => 'uid',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => '',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Cookiewarning.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_pxacookiebar_domain_model_cookiewarning.gif'
	),
);

?>