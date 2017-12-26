<?php
defined('TYPO3_MODE') or die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_pxacookiebar_domain_model_cookiewarning',
    'EXT:pxa_cookie_bar/Resources/Private/Language/locallang_csh_tx_pxacookiebar_domain_model_cookiewarning.xml'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_pxacookiebar_domain_model_cookiewarning'
);

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Pixelant.' . $_EXTKEY,
        'web',
        'mod1',
        '',
        [
            'CookieBarAdministration' => 'index'
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:pxa_cookie_bar/Resources/Public/Icons/cookies.svg',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_module.xlf',
        ]
    );
}
