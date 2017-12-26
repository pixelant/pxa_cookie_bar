<?php
declare(strict_types=1);

namespace Pixelant\PxaCookieBar\ViewHelpers\Backend;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * Class RecordEditUrlViewHelper
 * @package Pixelant\PxaCookieBar\ViewHelpers\Backend
 */
class RecordUrlViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Initialize arguments
     *
     * @api
     */
    public function initializeArguments()
    {
        $this->registerArgument('uid', 'int', 'Record uid or PID', true);
        $this->registerArgument('linkType', 'string', '"new" or "edit" type', true);
        $this->registerArgument('table', 'string', 'Table name', false, 'tx_pxacookiebar_domain_model_cookiewarning');
    }

    /**
     * Get link to process link
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     * @throws \Exception If link type is not support
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $table = $arguments['table'];
        $linkType = $arguments['linkType'];
        $uid = $arguments['uid'];

        return BackendUtility::getModuleUrl(
            'record_edit',
            [
                'edit[' . $table . '][' . $uid . ']' => $linkType,
                'returnUrl' => GeneralUtility::getIndpEnv('REQUEST_URI')
            ]
        );
    }
}
