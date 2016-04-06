<?php

namespace Pixelant\PxaCookieBar\ViewHelpers;

/**
 * Created by PhpStorm.
 * User: anjey
 * Date: 17.03.16
 * Time: 17:34
 */
class LinkViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


    /**
     * Initializes the arguments for the ViewHelper
     */
    public function initializeArguments() {
        $this->registerArgument('configuration', 'array', 'The typoLink configuration', TRUE);
        $this->registerArgument('targetBlank', 'boolean', 'If link target is blank', FALSE);
    }

    /**
     * @return mixed
     */
    public function render() {
        if((boolean)$this->arguments['targetBlank']) {
            $this->arguments['configuration']['parameter'] .= ' _blank';
        }

        return $GLOBALS['TSFE']->cObj->typoLink($this->renderChildren(), $this->arguments['configuration']);
    }
}