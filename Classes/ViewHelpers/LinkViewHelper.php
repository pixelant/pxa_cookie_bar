<?php

namespace Pixelant\PxaCookieBar\ViewHelpers;

use Pixelant\PxaCookieBar\Utility\CookieUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class LinkViewHelper
 * @package Pixelant\PxaCookieBar\ViewHelpers
 */
class LinkViewHelper extends AbstractViewHelper
{

    /**
     * Disable escaping of output
     *
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initializes the arguments for the ViewHelper
     */
    public function initializeArguments()
    {
        $this->registerArgument('configuration', 'array', 'The typoLink configuration', true);
        $this->registerArgument('targetBlank', 'boolean', 'If link target is blank', false, false);
        $this->registerArgument('class', 'string', 'Link class', false, '');
    }

    /**
     * @return mixed
     */
    public function render()
    {
        if ($this->arguments['targetBlank']) {
            $this->arguments['configuration']['parameter'] .= ' _blank';
        }
        if (!empty($this->arguments['class'])) {
            $this->arguments['configuration']['ATagParams'] = sprintf('class="%s"', $this->arguments['class']);
        }

        return CookieUtility::getTSFE()->cObj->typoLink(
            $this->renderChildren(),
            $this->arguments['configuration']
        );
    }
}
