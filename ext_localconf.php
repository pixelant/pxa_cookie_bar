<?php
defined('TYPO3_MODE') or die('Access denied.');

$boot = function ($_EXTKEY) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Pixelant.' . $_EXTKEY,
        'Pxacookiebar',
        [
            'Cookiewarning' => 'warning, closeWarning'
        ],
        [
            'Cookiewarning' => 'closeWarning'
        ]
    );

    if (TYPO3_MODE === 'FE') {
        $hook = \Pixelant\PxaCookieBar\Hooks\ContentPostProc::class . '->contentPostProcAll';
        $TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][$_EXTKEY] = $hook;
    }
};

$boot($_EXTKEY);
unset($boot);
