<?php
declare(strict_types=1);

namespace Pixelant\PxaCookieBar\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017
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

use Pixelant\PxaCookieBar\Utility\BackendTranslateUtility;
use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

/**
 * Class CookieBarAdministrationController
 * @package Pixelant\PxaCookieBar\Controller
 */
class CookieBarAdministrationController extends ActionController
{
    /**
     * Backend Template Container
     *
     * @var BackendTemplateView
     */
    protected $defaultViewObjectName = BackendTemplateView::class;

    /**
     * BackendTemplateContainer
     *
     * @var BackendTemplateView
     */
    protected $view = null;

    /**
     * @var \Pixelant\PxaCookieBar\Domain\Repository\CookieWarningRepository
     * @inject
     */
    protected $cookieWarningRepository = null;

    /**
     * Array of db row of current selected page
     *
     * @var array
     */
    protected $currentPageInfo = [];

    /**
     * Current page
     *
     * @var int
     */
    protected $pageUid = 0;

    /**
     * Determinate if current page is site root
     *
     * @var bool
     */
    protected $isSiteRoot = false;

    /**
     * Set up the doc header properly here
     *
     * @param ViewInterface $view
     * @return void
     */
    protected function initializeView(ViewInterface $view)
    {
        /** @var BackendTemplateView $view */
        parent::initializeView($view);

        // Need to run before menu is created to know if new button is visible
        $this->initialize();

        if ($this->isSiteRoot
            && $this->cookieWarningRepository->countByPid($this->pageUid) === 0
        ) {
            $this->createButtons();
        }
    }

    /**
     * Initialize
     *
     * @return void
     */
    protected function initialize()
    {
        $this->pageUid = (int)GeneralUtility::_GET('id');

        if ($this->pageUid) {
            $page = BackendUtility::getRecord('pages', $this->pageUid, 'is_siteroot');
            $this->isSiteRoot = is_array($page) && (bool)$page['is_siteroot'];
        }
    }

    /**
     * Main action
     */
    public function indexAction()
    {
        if ($this->pageUid) {
            $this->view->assignMultiple([
                'isRoot' => $this->isSiteRoot,
                'pid' => $this->pageUid,
                'cookieWarning' => $this->cookieWarningRepository->findByPid($this->pageUid)
            ]);
        }
    }

    /**
     * Add menu buttons for specific actions
     *
     * @return void
     */
    protected function createButtons()
    {
        if ($this->view->getModuleTemplate() !== null) {
            /** @var IconFactory $iconFactory */
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
            $buttonBar = $this->view->getModuleTemplate()->getDocHeaderComponent()->getButtonBar();

            $button = $buttonBar
                ->makeLinkButton()
                ->setHref($this->buildNewCookieWarningUrl())
                ->setTitle(BackendTranslateUtility::translate('be.create_new'))
                ->setIcon($iconFactory->getIcon('actions-document-new', Icon::SIZE_SMALL));

            $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_LEFT);
        }
    }

    /**
     * Generate url to create new survey
     *
     * @return string
     */
    protected function buildNewCookieWarningUrl(): string
    {
        $url = BackendUtility::getModuleUrl(
            'record_edit',
            [
                'edit[tx_pxacookiebar_domain_model_cookiewarning][' . $this->pageUid . ']' => 'new',
                'returnUrl' => GeneralUtility::getIndpEnv('REQUEST_URI')
            ]
        );

        return $url;
    }
}
