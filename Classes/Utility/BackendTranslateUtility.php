<?php
declare(strict_types=1);
namespace Pixelant\PxaCookieBar\Utility;

use TYPO3\CMS\Core\Localization\LanguageService;

/**
 * Class BackendTranslateUtility
 * @package Pixelant\PxaCookieBar\Utility
 */
class BackendTranslateUtility
{
    /**
     * Translate label
     *
     * @param string $key
     * @param array $arguments
     * @return string
     */
    public static function translate(string $key, array $arguments = []): string
    {
        $label = self::getLanguageService()->sL(
            'LLL:EXT:pxa_cookie_bar/Resources/Private/Language/locallang_be.xlf:' . $key
        );

        if (!empty($arguments)) {
            return vsprintf(
                $label,
                $arguments
            );
        }

        return $label;
    }

    /**
     * @return LanguageService
     */
    public static function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
