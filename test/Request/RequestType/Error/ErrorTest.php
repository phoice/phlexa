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

namespace PhlexaTest\Request\RequestType\Error;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\RequestType\Error\Error;

/**
 * Class ErrorTest
 *
 * @package PhlexaTest\Request\Session
 */
class ErrorTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $error = new Error('type', 'message');

        $this->assertEquals('type', $error->getType());
        $this->assertEquals('message', $error->getMessage());
    }
}
