<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function ($_EXTKEY) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Pixelant.' . $_EXTKEY,
            'Pi1',
            [
                'CookieWarning' => 'warningMessage, getJsCookieWarningSettings'
            ]
        );

        if (TYPO3_MODE === 'FE') {
            $hook = \Pixelant\PxaCookieBar\Hooks\ContentPostProc::class . '->contentPostProcAll';
            // @codingStandardsIgnoreStart
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][$_EXTKEY] = $hook;
            // @codingStandardsIgnoreEnd
        }
    },
    $_EXTKEY
);
