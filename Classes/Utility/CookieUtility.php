<?php


class Tx_PxaCookieBar_Utility_CookieUtility {

    /**
     * clear all cookies
     * @return void
     */
    public static function removeAllCookies() {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
            setcookie($name, '', time()-1000, '/',substr($_SERVER['SERVER_NAME'],3));
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
