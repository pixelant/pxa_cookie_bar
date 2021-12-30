<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function (string $extKey) {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            $extKey,
            'warningMessage',
            [
                \Pixelant\PxaCookieBar\Controller\CookieWarningController::class => 'warningMessage',
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            $extKey,
            'jsCookieWarningSettings',
            [
                \Pixelant\PxaCookieBar\Controller\CookieWarningController::class => 'getJsCookieWarningSettings',
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            $extKey,
            'closeCookieBar',
            [
                \Pixelant\PxaCookieBar\Controller\CookieWarningController::class => 'closeCookieBar'
            ]
        );

        if (TYPO3_MODE === 'FE') {
            $hook = \Pixelant\PxaCookieBar\Hooks\ContentPostProcessor::class . '->process';
            // @codingStandardsIgnoreStart
            $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output']['pxa_cookie_bar'] = $hook;
            // @codingStandardsIgnoreEnd
        }
    },
    'PxaCookieBar'
);
