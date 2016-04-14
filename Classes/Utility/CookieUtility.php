<?php

namespace Pixelant\PxaCookieBar\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class CookieUtility {

    /**
     * clear all cookies
     * @return void
     */
    public static function removeAllCookies() {
        $cookies = GeneralUtility::trimExplode(';', $_SERVER['HTTP_COOKIE'], TRUE);

        foreach($cookies as $cookie) {
            $parts = GeneralUtility::trimExplode('=', $cookie, TRUE);

            if($parts[0] !== 'be_typo_user') {
                $host = GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY');
                $subdomain = substr($host, 0, 3) === 'www' ? substr($host, 3) : ('.' . $host);

                setcookie($parts[0], '', time()-1000);
                setcookie($parts[0], '', time()-1000, '/');
                setcookie($parts[0], '', time()-1000, '/', $host);
                setcookie($parts[0], '', time()-1000, '/', $subdomain);
            }
        }

        self::removeFEUserCookie();
    }

    /**
     * remvoe fe_user_cookie
     */
    public static function removeFEUserCookie() {
        setcookie('fe_typo_user', '', time()-1000);
        setcookie('fe_typo_user', '', time()-1000, '/');
        setcookie('fe_typo_user', '', time()-1000, '/',substr($_SERVER['SERVER_NAME'],3));
    }
}
