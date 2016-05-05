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
use Pixelant\PxaCookieBar\Utility\CookieUtility;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 *
 *
 * @package pxa_cookie_bar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CookiewarningController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * @var \Pixelant\PxaCookieBar\Domain\Repository\CookiewarningRepository
     * @inject
     */
    protected $cookiewarningRepository;

    /**
     * action warning
     *
     * @return void
     */
    public function warningAction() {
        if ($_COOKIE['pxa_cookie_warning'] || ($this->settings['showOnlyOnLogin'] && !$this->getTSFE()->loginUser)) {
            $this->view->assign('show', '0');
        } else {
            if (!intval($this->settings['disableCookies'])) {
                setcookie('pxa_cookie_warning', 1, time() + 60 * 60 * 24 * 30 * 12, '/');
            }

            $messages = $this->cookiewarningRepository->findSomething();

            if ($messages) {
                $this->view->assign('message', $messages->getWarningmessage());
                $this->view->assign('moretext', $messages->getLinktext());
                $this->view->assign('page', $messages->getPage());
            } else {
                $this->view->assign('page', $this->settings['page']);
            }

            // check if CDN is enabled
            if($this->settings['isCDN'] == 1 && ($cdnDomain = $this->getCdnDomain())) {
                # allow subdomain request
                $this->response->setHeader('Access-Control-Allow-Origin', GeneralUtility::getIndpEnv('TYPO3_SSL') ? 'https' : 'http' . '://' . $cdnDomain);
            }
            $this->view->assign('show', '1');
        }
    }

    /**
     * action closeWarning
     *
     * @return void
     */
    public function closeWarningAction() {
        setcookie('pxa_cookie_warning', 1, time() + 60 * 60 * 24 * 30 * 12, '/');
        exit(0);
    }

    /**
     * check if CDN is enabled and return domain
     *
     * @return string
     */
    private function getCdnDomain() {
        $domain = BackendUtility::firstDomainRecord($this->getTSFE()->rootLine);
        $domainRecord = BackendUtility::getDomainStartPage($domain);

        return $domainRecord['tx_pxacdn_enable'] == 1 ? $domainRecord['domainName'] : '';
    }

    /**
     * @return \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
     */
    private function getTSFE() {
        return $GLOBALS['TSFE'];
    }
}