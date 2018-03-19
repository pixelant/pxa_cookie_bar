<?php
declare(strict_types=1);
namespace Pixelant\PxaCookieBar\Hooks;

use Pixelant\PxaCookieBar\Utility\CookieUtility;

/**
 * Class ContentPostProcessor
 * @package Pixelant\PxaCookieBar\Hooks
 */
class ContentPostProcessor
{

    /**
     * Check if using cookies is allowed
     *
     * @return void
     */
    public function process()
    {
        $settings = CookieUtility::getSettings();

        if (!isset($_COOKIE['pxa_cookie_warning']) && $settings['activeConsent']) {
            if (session_id()) {
                setcookie(session_name(), session_id(), time() - 60 * 60 * 24, '/');
                session_unset();
                session_destroy();
            }

            CookieUtility::removeAllCookies();
        }
    }
}
