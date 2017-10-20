<?php

namespace Pixelant\PxaCookieBar\ViewHelpers\Backend;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Lang\LanguageService;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * Class TranslateViewHelper
 * @package Pixelant\PxaCookieBar\ViewHelpers\Backend
 */
class TranslateViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Path to translation file
     *
     * @var string
     */
    protected static $LLL = 'LLL:EXT:pxa_cookie_bar/Resources/Private/Language/locallang_be.xlf:';

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        $this->registerArgument('key', 'string', 'Key', false, '');
    }

    /**
     * Translate BE key
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {

        $key = $arguments['key'];
        if (empty($key)) {
            $key = trim($renderChildrenClosure());
        }

        /** @var LanguageService $lang */
        $lang = $GLOBALS['LANG'];

        return $lang->sL(self::$LLL . $key);
    }
}
