<?php

namespace Pixelant\PxaCookieBar\Tests\Unit\Utility;

use PHPUnit\Framework\TestCase;
use Pixelant\PxaCookieBar\Utility\CookieUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class CookieUtilityTest extends TestCase
{
    public function setUp()
    {
        $GLOBALS['TSFE'] = $this->createMock(TypoScriptFrontendController::class);
    }

    public function tearDown()
    {
        unset($GLOBALS['TSFE']);
    }

    /**
     * @test
     */
    public function settingsCanBeSet()
    {
        $settings = [
            'test' => 1
        ];

        CookieUtility::setSettings($settings);

        $this->assertEquals(
            $settings,
            CookieUtility::getSettings()
        );
    }

    /**
     * @test
     */
    public function getTSFEWillReturnTypoScriptFrontendController()
    {
        $this->assertSame($GLOBALS['TSFE'], CookieUtility::getTSFE());
    }
}
