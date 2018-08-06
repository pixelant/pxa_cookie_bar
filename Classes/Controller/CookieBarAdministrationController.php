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

use Pixelant\PxaCookieBar\Domain\Repository\CookieWarningRepository;
use Pixelant\PxaCookieBar\Utility\BackendTranslateUtility;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList;

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
     */
    protected $cookieWarningRepository = null;

    /**
     * @param CookieWarningRepository $cookieWarningRepository
     */
    public function injectCookieWarningRepository(CookieWarningRepository $cookieWarningRepository)
    {
        $this->cookieWarningRepository = $cookieWarningRepository;
    }

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
     * Current page row
     *
     * @var array
     */
    protected $pageRow = [];

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

        $pageRenderer = $this->view->getModuleTemplate()->getPageRenderer();

        $pageRenderer->loadRequireJsModule('TYPO3/CMS/Backend/AjaxDataHandler');

        // Add JavaScript functions to the page:
        $this->view->getModuleTemplate()->addJavaScriptCode(
            'RecordListInlineJS',
            '
				function jumpExt(URL,anchor) {
					var anc = anchor?anchor:"";
					window.location.href = URL+(T3_THIS_LOCATION?"&returnUrl="+T3_THIS_LOCATION:"")+anc;
					return false;
				};
			'
        );

        if ($this->isSiteRoot && $this->isNewCookieBarAllowed()) {
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
            $page = BackendUtility::getRecord('pages', $this->pageUid);
            if (is_array($page)) {
                $this->isSiteRoot = (bool)$page['is_siteroot'];
                $this->pageRow = $page;
            }
        }
    }

    /**
     * Main action
     */
    public function indexAction()
    {
        if ($this->pageUid) {
            $countRecords = $this->cookieWarningRepository->countByPid($this->pageUid);

            if ($countRecords > 1) {
                $this->addFlashMessage(
                    BackendTranslateUtility::translate('be.error.too_many'),
                    BackendTranslateUtility::translate('be.error'),
                    FlashMessage::ERROR
                );
            }
            if ($countRecords > 0) {
                $this->view->assign('htmlDbList', $this->getDbListHTML());
            } else {
                $this->view->assign('newRecordUrl', $this->buildNewCookieWarningUrl());
            }

            $this->view->assignMultiple([
                'isRoot' => $this->isSiteRoot,
                'pid' => $this->pageUid,
                'requestUri' => GeneralUtility::quoteJSvalue(rawurlencode(GeneralUtility::getIndpEnv('REQUEST_URI')))
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
     * Records list html
     *
     * @return string
     */
    protected function getDbListHTML(): string
    {
        /** @var DatabaseRecordList $dbList */
        $dbList = GeneralUtility::makeInstance(DatabaseRecordList::class);
        $dbList->script = GeneralUtility::getIndpEnv('REQUEST_URI');
        $dbList->thumbs = $this->getBackendUser()->uc['thumbnailsByDefault'];
        $dbList->allFields = 1;
        $dbList->localizationView = 1;
        $dbList->clickTitleMode = 'edit';
        $dbList->calcPerms = $this->getBackendUser()->calcPerms($this->pageRow);
        $dbList->showClipboard = 0;
        $dbList->disableSingleTableView = 1;
        $dbList->pageRow = $this->pageRow;
        $dbList->displayFields = [];
        $dbList->dontShowClipControlPanels = true;
        $dbList->counter++;
        $pointer = MathUtility::forceIntegerInRange(GeneralUtility::_GP('pointer'), 0);

        $dbList->start(
            $this->pageUid,
            'tx_pxacookiebar_domain_model_cookiewarning',
            $pointer
        );

        $dbList->generateList();

        return $dbList->HTMLcode;
    }

    /**
     * Generate url to create new survey
     *
     * @return string
     */
    protected function buildNewCookieWarningUrl(): string
    {
        $url = (string)GeneralUtility::makeInstance(UriBuilder::class)->buildUriFromRoute(
            'record_edit',
            [
                'edit[tx_pxacookiebar_domain_model_cookiewarning][' . $this->pageUid . ']' => 'new',
                'returnUrl' => GeneralUtility::getIndpEnv('REQUEST_URI')
            ]
        );

        return $url;
    }

    /**
     * Check if it's allowed to create new cookie warnings
     *
     * @return bool
     */
    protected function isNewCookieBarAllowed(): bool
    {
        return $this->pageUid !== 0 && ($this->cookieWarningRepository->countByPid($this->pageUid) === 0);
    }

    /**
     * Get backend user
     *
     * @return BackendUserAuthentication
     */
    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }
}
