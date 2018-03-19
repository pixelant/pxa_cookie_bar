<?php

namespace Pixelant\PxaCookieBar\Tests\Unit\Controller;

use Pixelant\PxaCookieBar\Controller\CookieWarningController;
use Pixelant\PxaCookieBar\Utility\CookieUtility;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\BaseTestCase;

/**
 * Class CookieWarningControllerTest
 * @package Pixelant\PxaCookieBar\Tests\Unit\Controller
 */
class CookieWarningControllerTest extends BaseTestCase
{
    /**
     * @var CookieWarningController|AccessibleObjectInterface
     */
    protected $subject = null;

    public function setUp()
    {
        $this->subject = $this->getAccessibleMock(
            CookieWarningController::class,
            ['getCookieWarning'],
            [],
            '',
            false,
            false
        );
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function gettingSettingsReturnJsonEncodedSettingsEndSetItInCookieUtility()
    {
        $settings = [
            'activeConsent' => true,
            'oneTimeVisible' => true
        ];

        $this->subject->_set('settings', $settings);

        $this->assertEquals(json_encode($settings), $this->subject->getJsCookieWarningSettingsAction());

        $this->assertEquals(
            $settings,
            CookieUtility::getSettings()
        );
    }
}
