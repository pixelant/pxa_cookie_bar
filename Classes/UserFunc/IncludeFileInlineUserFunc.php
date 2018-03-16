<?php
declare(strict_types=1);
namespace Pixelant\PxaCookieBar\UserFunc;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class IncludeFileInlineUserFunc
 * @package Pixelant\PxaCookieBar\UserFunc
 */
class IncludeFileInlineUserFunc
{
    /**
     * Return file as inline
     *
     * @param string $content
     * @param array $params
     * @return string
     */
    public function includeFile(string $content, array $params): string
    {
        if (!empty($params['file'])) {
            $filePath = GeneralUtility::getFileAbsFileName($params['file']);
            if (file_exists($filePath)) {
                $content = GeneralUtility::getUrl($filePath);
            }
        }

        return $content ?? '';
    }
}
