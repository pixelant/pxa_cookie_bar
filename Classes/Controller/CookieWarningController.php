<?php

namespace Pixelant\PxaCookieBar\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use Pixelant\PxaCookieBar\Domain\Model\CookieWarning;
use Pixelant\PxaCookieBar\Utility\CookieUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 *
 *
 * @package pxa_cookie_bar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CookieWarningController extends ActionController
{

    /**
     * @var \Pixelant\PxaCookieBar\Domain\Repository\CookieWarningRepository
     * @inject
     */
    protected $cookieWarningRepository;

    /**
     * Render message
     *
     * @return void
     */
    public function warningMessageAction()
    {
        $this->view->assign('cookieWarning', $this->getCookieWarning());
    }

    /**
     * Convert warning message to json settings
     */
    public function getJsCookieWarningSettingsAction()
    {
        $cookieWarning = $this->getCookieWarning();
        $settings = [
            'activeConsent' =>
                (bool)($cookieWarning ? $cookieWarning->isActiveConsent() : $this->settings['activeConsent']),
            'oneTimeVisible' =>
                (bool)($cookieWarning ? $cookieWarning->isOneTimeVisible() : $this->settings['oneTimeVisible'])
        ];

        // Save settings for later ContentPostProcessor hook
        CookieUtility::setSettings($settings);

        return json_encode($settings);
    }

    /**
     * Just to send close cookie bar cookie
     */
    public function closeCookieBarAction()
    {
        setcookie('pxa_cookie_warning', 1, time() + 60 * 60 * 24 * 30 * 12, '/');
        exit(0);
    }

    /**
     * Get cookie warning
     *
     * @return CookieWarning|bool
     */
    protected function getCookieWarning()
    {
        /** @var CookieWarning $cookieWarning */
        static $cookieWarning;

        // Use one cookie object everywhere
        if ($cookieWarning === null) {
            $rootLine = array_reverse(CookieUtility::getTSFE()->rootLine ?: []);

            foreach ($rootLine as $rootLineItem) {
                if ((int)$rootLineItem['is_siteroot'] === 1) {
                    /** @var CookieWarning $cookieWarning */
                    $cookieWarning = $this->cookieWarningRepository->findByPid((int)$rootLineItem['uid']) ?: false;
                }
            }
        }

        return $cookieWarning;
    }
}
