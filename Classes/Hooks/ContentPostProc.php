<?php
namespace Pixelant\PxaCookieBar\Hooks;

use Pixelant\PxaCookieBar\Utility\CookieUtility;

/**
 * Class ContentPostProc
 * @package Pixelant\PxaCookieBar\Hooks
 */
class ContentPostProc
{

    /**
     * Check if using cookies is allowed
     *
     * @return void
     */
    public function contentPostProcAll()
    {
        $settings = CookieUtility::getSettings();

        if (!isset($_COOKIE['pxa_cookie_warning'])
            && (int)$settings['disableCookies'] === 1
            && (int)$settings['enable'] === 1
        ) {
            if (session_id()) {
                setcookie(session_name(), session_id(), time() - 60 * 60 * 24, '/');
                session_unset();
                session_destroy();
            }
            CookieUtility::removeAllCookies();
        }
    }
}
