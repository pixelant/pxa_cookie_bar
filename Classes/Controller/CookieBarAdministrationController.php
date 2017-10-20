<?php

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

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Lang\LanguageService;

/**
 * Class CookieBarAdministrationController
 * @package Pixelant\PxaCookieBar\Controller
 */
class CookieBarAdministrationController extends AbstractController
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
    protected $view;

    /**
     * @var \Pixelant\PxaCookieBar\Domain\Repository\CookieWarningRepository
     * @inject
     */
    protected $cookieWarningRepository;

    /**
     * Array of db row of current selected page
     *
     * @var array
     */
    protected $currentPageInfo;

    /**
     * Current page
     *
     * @var int
     */
    protected $pageUid;

    /**
     * initializeAction
     *
     * @return void
     */
    public function initializeAction()
    {
        $this->pageUid = (int)GeneralUtility::_GET('id');
    }


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

        $this->createButtons();
    }

    /**
     * Main action
     */
    public function indexAction()
    {
        if ($this->pageUid) {
            $page = BackendUtility::getRecord('pages', $this->pageUid, 'is_siteroot');
            $isSiteRoot = is_array($page) && $page['is_siteroot'];

            $this->view->assignMultiple([
                'isRoot' => $isSiteRoot,
                'cookieWarnings' => $this->cookieWarningRepository->findAll()
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
            $uriBuilder = $this->uriBuilder->reset();
            /** @var IconFactory $iconFactory */
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
            $buttonBar = $this->view->getModuleTemplate()->getDocHeaderComponent()->getButtonBar();

            $button = $buttonBar
                ->makeLinkButton()
                ->setHref($uriBuilder->reset()->uriFor('createNewRecord'))
                ->setTitle($this->translate('be.create_new'))
                ->setIcon($iconFactory->getIcon('actions-document-new', Icon::SIZE_SMALL));

            $buttonBar->addButton($button, ButtonBar::BUTTON_POSITION_LEFT);
        }
    }

    /**
     * Translate label
     *
     * @param string $key
     * @return string
     */
    protected function translate(string $key): string
    {
        return $this->getLanguageService()->sL(
            'LLL:EXT:pxa_cookie_bar/Resources/Private/Language/locallang_be.xlf:' . $key
        );
    }

    /**
     * @return LanguageService
     */
    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
