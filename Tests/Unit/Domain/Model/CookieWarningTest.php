<?php

namespace Pixelant\PxaCookieBar\Tests\Unit\Domain\Model;

use PHPUnit\Framework\TestCase;
use Pixelant\PxaCookieBar\Domain\Model\CookieWarning;

/**
 * Class CookieWarning
 * @package Pixelant\PxaCookieBar\Tests\Unit\Domain\Model
 */
class CookieWarningTest extends TestCase
{
    /**
     * @var CookieWarning
     */
    protected $subject = null;

    public function setUp()
    {
        $this->subject = new CookieWarning();
    }

    public function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function defaultNameIsEmpty()
    {
        $this->assertEmpty($this->subject->getName());
    }

    /**
     * @test
     */
    public function nameCanBeSet()
    {
        $name = 'test';

        $this->subject->setName($name);
        $this->assertEquals($name, $this->subject->getName());
    }

    /**
     * @test
     */
    public function defaultWarningMessageIsEmpty()
    {
        $this->assertEmpty($this->subject->getWarningMessage());
    }

    /**
     * @test
     */
    public function warningMessageCanBeSet()
    {
        $value = 'test';

        $this->subject->setWarningMessage($value);
        $this->assertEquals($value, $this->subject->getWarningMessage());
    }

    /**
     * @test
     */
    public function defaultLinkTextIsEmpty()
    {
        $this->assertEmpty($this->subject->getLinkText());
    }

    /**
     * @test
     */
    public function linkTextCanBeSet()
    {
        $value = 'test';

        $this->subject->setLinkText($value);
        $this->assertEquals($value, $this->subject->getLinkText());
    }

    /**
     * @test
     */
    public function defaultLinkTargetIsEmpty()
    {
        $this->assertEmpty($this->subject->getLinkTarget());
    }

    /**
     * @test
     */
    public function linkTargetCanBeSet()
    {
        $value = 'test';

        $this->subject->setLinkTarget($value);
        $this->assertEquals($value, $this->subject->getLinkTarget());
    }

    /**
     * @test
     */
    public function activeConsentByDefaultFalse()
    {
        $this->assertFalse($this->subject->isActiveConsent());
    }

    /**
     * @test
     */
    public function activeConsentCanBeSet()
    {
        $this->subject->setActiveConsent(true);
        $this->assertTrue($this->subject->isActiveConsent());
    }

    /**
     * @test
     */
    public function oneTimeVisibleByDefaultFalse()
    {
        $this->assertFalse($this->subject->isOneTimeVisible());
    }

    /**
     * @test
     */
    public function oneTimeVisibleCanBeSet()
    {
        $this->subject->setOneTimeVisible(true);
        $this->assertTrue($this->subject->isOneTimeVisible());
    }
}
