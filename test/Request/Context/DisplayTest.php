<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

declare(strict_types=1);

namespace PhlexaTest\Request\Context;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\Context\Display;

/**
 * Class DisplayTest
 *
 * @package PhlexaTest\Request\Context
 */
class DisplayTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $display = new Display();

        $this->assertNull($display->getTemplateVersion());
        $this->assertNull($display->getMarkupVersion());
        $this->assertNull($display->getToken());
    }

    /**
     *
     */
    public function testToken()
    {
        $display = new Display();
        $display->setToken('123456');

        $expected = '123456';

        $this->assertEquals($expected, $display->getToken());
    }

    /**
     *
     */
    public function testTemplateVersion()
    {
        $display = new Display();
        $display->setTemplateVersion('1.0');

        $expected = '1.0';

        $this->assertEquals($expected, $display->getTemplateVersion());
    }

    /**
     *
     */
    public function testMarkupVersion()
    {
        $display = new Display();
        $display->setMarkupVersion('1.0');

        $expected = '1.0';

        $this->assertEquals($expected, $display->getMarkupVersion());
    }
}
