<?php

namespace Pixelant\PxaCookieBar\Tests\Unit\Utility;

use PHPUnit\Framework\TestCase;
use Pixelant\PxaCookieBar\Utility\BackendTranslateUtility;
use TYPO3\CMS\Lang\LanguageService;

class BackendTranslateUtilityTest extends TestCase
{
    public function setUp()
    {
        $GLOBALS['LANG'] = $this->createMock(LanguageService::class);
    }

    public function tearDown()
    {
        unset($GLOBALS['LANG']);
    }

    /**
     * @test
     */
    public function getLanguageServiceWillReturnLanguageService()
    {
        $this->assertSame($GLOBALS['LANG'], BackendTranslateUtility::getLanguageService());
    }
}
