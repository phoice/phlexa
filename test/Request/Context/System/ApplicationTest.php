<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 *
 */

namespace PhlexaTest\Request\Context\System;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\Context\System\Application;

/**
 * Class ApplicationTest
 *
 * @package PhlexaTest\Request\Context\System
 */
class ApplicationTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $application = new Application('applicationId');

        $expected = 'applicationId';

        $this->assertEquals($expected, $application->getApplicationId());
    }
}
