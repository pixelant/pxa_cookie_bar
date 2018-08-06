<?php
declare(strict_types=1);
namespace Pixelant\PxaCookieBar\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Andriy <andriy@pixelant.se>, Pixelant
 *
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

use Pixelant\PxaCookieBar\Domain\Model\CookieWarning;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 *
 *
 * @package pxa_cookie_warning
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CookieWarningRepository extends Repository
{

    /**
     * Initialize default query settings
     */
    public function initializeObject()
    {
        /** @var $defaultQuerySettings Typo3QuerySettings */
        $defaultQuerySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $defaultQuerySettings->setRespectStoragePage(false);

        $this->setDefaultQuerySettings($defaultQuerySettings);
    }

    /**
     * Get warning message for current root page
     *
     * @param int $pid
     * @return CookieWarning|object
     */
    public function findByPid(int $pid)
    {
        $query = $this->createQuery();

        $query->matching(
            $query->equals('pid', $pid)
        );
        $query->setLimit(1);

        return $query->execute()->getFirst();
    }

    /**
     * Count warning message for current root page
     *
     * @param int $pid
     * @return int
     */
    public function countByPidRespectDisabled(int $pid): int
    {
        $query = $this->createQuery();

        $query->getQuerySettings()
            ->setIgnoreEnableFields(true)
            ->setEnableFieldsToBeIgnored(['disable']);

        $query->matching(
            $query->equals('pid', $pid)
        );

        return $query->count();
    }
}
