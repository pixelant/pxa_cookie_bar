<?php

namespace Pixelant\PxaCookieBar\Tests\Unit\Controller;

use Pixelant\PxaCookieBar\Controller\CookieBarAdministrationController;
use Pixelant\PxaCookieBar\Domain\Repository\CookieWarningRepository;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\BaseTestCase;

class CookieBarAdministrationControllerTest extends BaseTestCase
{
    /**
     * @var CookieBarAdministrationController|AccessibleObjectInterface
     */
    protected $subject = null;

    public function setUp()
    {
        $this->subject = $this->getAccessibleMock(
            CookieBarAdministrationController::class,
            ['dummy'],
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
    public function ifPageNotSetNewCookieBarIsNotAllowed()
    {
        $this->subject->_set('pageUid', 0);

        $this->assertFalse($this->subject->_call('isNewCookieBarAllowed'));
    }

    /**
     * @test
     */
    public function ifCookieBarExistNewCookieBarIsNotAllowed()
    {
        $pageUid = 123;
        $this->subject->_set('pageUid', $pageUid);

        $mockedRepository = $this->createPartialMock(CookieWarningRepository::class, ['countByPid']);
        $mockedRepository
            ->expects($this->once())
            ->method('countByPid')
            ->with($pageUid)
            ->will($this->returnValue(1));

        $this->subject->_set('cookieWarningRepository', $mockedRepository);

        $this->assertFalse($this->subject->_call('isNewCookieBarAllowed'));
    }

    /**
     * @test
     */
    public function itsPossibleToCreateNewCookieBarIfPageIsSetAndNoRecordsFound()
    {
        $pageUid = 123;
        $this->subject->_set('pageUid', $pageUid);

        $mockedRepository = $this->createPartialMock(CookieWarningRepository::class, ['countByPid']);
        $mockedRepository
            ->expects($this->once())
            ->method('countByPid')
            ->with($pageUid)
            ->will($this->returnValue(0));

        $this->subject->_set('cookieWarningRepository', $mockedRepository);

        $this->assertTrue($this->subject->_call('isNewCookieBarAllowed'));
    }
}
