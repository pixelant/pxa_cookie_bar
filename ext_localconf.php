<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Pixelant.PxaCookieBar',
            'Pi1',
            [
                'CookieWarning' => 'warningMessage, getJsCookieWarningSettings, closeCookieBar'
            ]
        );

        if (TYPO3_MODE === 'FE') {
            $hook = \Pixelant\PxaCookieBar\Hooks\ContentPostProcessor::class . '->process';
            // @codingStandardsIgnoreStart
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output']['pxa_cookie_bar'] = $hook;
            // @codingStandardsIgnoreEnd
        }
    }

);
