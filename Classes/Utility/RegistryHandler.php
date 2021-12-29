<?php
declare(strict_types=1);
namespace Pixelant\PxaCookieBar\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Registry;

/**
 * Class RegistryHandler
 * @package Pixelant\PxaCookieBar\Utility
 */
class RegistryHandler
{
    const COOKIE_BAR_REGISTRY_KEY = 'pxa_cookie_bar';
    const COOKIE_BAR_REGISTRY_TOKEN_KEY = 'settings';

    /**
     * @var Registry
     */
    protected $registry;

    public function __construct()
    {
        $this->registry = GeneralUtility::makeInstance(Registry::class);
    }

    /**
     * Save the settings in TYPO3 System Registry
     *
     * @param array $settings
     */
    public function saveSettings(array $settings): void
    {
        $this->registry->set(
            self::COOKIE_BAR_REGISTRY_KEY,
            self::COOKIE_BAR_REGISTRY_TOKEN_KEY,
            $settings
        );
    }

    /**
     * Get the saved settings from TYPO3 System Registry
     *
     * @return array
     */
    public function getSavedSettings(): array
    {
        return $this->registry->get(
            self::COOKIE_BAR_REGISTRY_KEY,
            self::COOKIE_BAR_REGISTRY_TOKEN_KEY
        ) ?: [];
    }

}
