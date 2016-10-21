<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "pxa_cookie_bar".
 *
 * Auto generated 06-08-2013 17:23
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Cookie bar',
	'description' => 'Text and link for page with cookie.',
	'category' => 'plugin',
	'author' => 'Andriy Oprysko, Tony',
	'author_email' => 'andriy@pixelant.se',
	'author_company' => 'Pixelant',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => '2.0.0',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.1',
	'constraints' => array(
		'depends' => array(
			'extbase' => '1.3',
			'fluid' => '1.3',
			'typo3' => '6.0.0-7.6.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:28:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"cac5";s:14:"ext_tables.php";s:4:"3fbf";s:14:"ext_tables.sql";s:4:"16a5";s:21:"ExtensionBuilder.json";s:4:"9d83";s:14:"pxa_cookie.zip";s:4:"0175";s:46:"Classes/Controller/CookiewarningController.php";s:4:"05ff";s:38:"Classes/Domain/Model/Cookiewarning.php";s:4:"e937";s:53:"Classes/Domain/Repository/CookiewarningRepository.php";s:4:"b918";s:44:"Configuration/ExtensionBuilder/settings.yaml";s:4:"ad41";s:35:"Configuration/TCA/Cookiewarning.php";s:4:"63d4";s:38:"Configuration/TypoScript/constants.txt";s:4:"ce07";s:34:"Configuration/TypoScript/setup.txt";s:4:"121d";s:40:"Resources/Private/Language/locallang.xml";s:4:"d08f";s:87:"Resources/Private/Language/locallang_csh_tx_pxacookiebar_domain_model_cookiewarning.xml";s:4:"7b34";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"14c7";s:38:"Resources/Private/Layouts/Default.html";s:4:"7cb6";s:54:"Resources/Private/Templates/Cookiewarning/Warning.html";s:4:"5fa8";s:28:"Resources/Public/Css/bar.css";s:4:"5ee6";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:69:"Resources/Public/Icons/tx_pxacookiebar_domain_model_cookiewarning.gif";s:4:"1103";s:39:"Resources/Public/Js/jquery-1.9.1.min.js";s:4:"3977";s:41:"Resources/Public/Js/pxa_cookie_warning.js";s:4:"c998";s:42:"Resources/Public/Js/pxa_cookie_warning_.js";s:4:"8ad2";s:30:"Resources/Public/Js/require.js";s:4:"aa57";s:53:"Tests/Unit/Controller/CookiewarningControllerTest.php";s:4:"4f17";s:45:"Tests/Unit/Domain/Model/CookiewarningTest.php";s:4:"e341";s:14:"doc/manual.sxw";s:4:"8d2d";}',
);