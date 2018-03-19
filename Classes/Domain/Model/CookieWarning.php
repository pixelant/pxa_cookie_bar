<?php
declare(strict_types=1);
namespace Pixelant\PxaCookieBar\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013
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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 *
 *
 * @package pxa_cookie_bar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CookieWarning extends AbstractEntity
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * Warning message
     *
     * @var string
     */
    protected $warningMessage = '';

    /**
     * Link text
     *
     * @var string
     */
    protected $linkText = '';

    /**
     * Link
     *
     * @var string
     */
    protected $linkTarget = '';

    /**
     * @var bool
     */
    protected $activeConsent = false;

    /**
     * @var bool
     */
    protected $oneTimeVisible = false;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getWarningMessage(): string
    {
        return $this->warningMessage;
    }

    /**
     * @param string $warningMessage
     */
    public function setWarningMessage(string $warningMessage)
    {
        $this->warningMessage = $warningMessage;
    }

    /**
     * @return string
     */
    public function getLinkText(): string
    {
        return $this->linkText;
    }

    /**
     * @param string $linkText
     */
    public function setLinkText(string $linkText)
    {
        $this->linkText = $linkText;
    }

    /**
     * @return string
     */
    public function getLinkTarget(): string
    {
        return $this->linkTarget;
    }

    /**
     * @param string $linkTarget
     */
    public function setLinkTarget(string $linkTarget)
    {
        $this->linkTarget = $linkTarget;
    }

    /**
     * @return bool
     */
    public function isActiveConsent(): bool
    {
        return $this->activeConsent;
    }

    /**
     * @param bool $activeConsent
     */
    public function setActiveConsent(bool $activeConsent)
    {
        $this->activeConsent = $activeConsent;
    }

    /**
     * @return bool
     */
    public function isOneTimeVisible(): bool
    {
        return $this->oneTimeVisible;
    }

    /**
     * @param bool $oneTimeVisible
     */
    public function setOneTimeVisible(bool $oneTimeVisible)
    {
        $this->oneTimeVisible = $oneTimeVisible;
    }
}
