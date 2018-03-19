<?php
declare(strict_types=1);
namespace Pixelant\PxaCookieBar\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Class CookieUtility
 * @package Pixelant\PxaCookieBar\Utility
 */
class CookieUtility
{

    /**
     * Extension settings
     *
     * @var array
     */
    protected static $settings = [];

    /**
     * Get plugin settings
     *
     * @return array
     */
    public static function getSettings(): array
    {
        return self::$settings;
    }

    /**
     * Set settings
     *
     * @param array $settings
     */
    public static function setSettings(array $settings)
    {
        self::$settings = $settings;
    }

    /**
     * Clear all cookies
     *
     * @return void
     */
    public static function removeAllCookies()
    {
        $cookies = GeneralUtility::trimExplode(';', $_SERVER['HTTP_COOKIE'], true);
        $host = GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY');

        foreach ($cookies as $cookie) {
            $parts = GeneralUtility::trimExplode('=', $cookie, true);

            if ($parts[0] !== 'be_typo_user') {
                setcookie($parts[0], '', time() - 1000);
                setcookie($parts[0], '', time() - 1000, '/');
            }
        }

        self::removeFEUserCookie($host);
    }

    /**
     * Remove fe_user_cookie
     *
     * @param string $host
     * @return void
     */
    public static function removeFEUserCookie($host)
    {
        setcookie('fe_typo_user', '', time() - 1000);
        setcookie('fe_typo_user', '', time() - 1000, '/');
        setcookie('fe_typo_user', '', time() - 1000, '/', $host);
    }

    /**
     * @return TypoScriptFrontendController
     */
    public static function getTSFE(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'];
    }
}
