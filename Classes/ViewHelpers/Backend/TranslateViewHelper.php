<?php
declare(strict_types=1);
namespace Pixelant\PxaCookieBar\ViewHelpers\Backend;

use Pixelant\PxaCookieBar\Utility\BackendTranslateUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
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

        return BackendTranslateUtility::translate($key);
    }
}
