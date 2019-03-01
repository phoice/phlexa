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

namespace PhlexaTest\Request\Session;

use Phlexa\Request\Session\Application;
use PHPUnit\Framework\TestCase;

/**
 * Class ApplicationTest
 *
 * @package PhlexaTest\Request\Session
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
