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
        if (!$this->settings['forceCookieWarningRender']
            && ($_COOKIE['pxa_cookie_warning']
                || ($this->settings['showOnlyOnLogin'] && !CookieUtility::getTSFE()->loginUser))
        ) {
            $this->view->assign('show', false);
        } else {
            /** @var CookieWarning $messages */
            $messages = $this->cookiewarningRepository->findSomething();

            if ($messages !== null) {
                $this->view->assignMultiple([
                    'message' => $messages->getWarningmessage(),
                    'linkText' => $messages->getLinktext(),
                    'page' => $messages->getPage()
                ]);
            } else {
                $this->view->assign('page', $this->settings['page']);
            }

            if (!intval($this->settings['disableCookies']) && 0 === intval($this->settings['disableAjaxLoading'])) {
                $this->setCookie();
            }

            $this->view->assign('show', true);
        }
    }
}
