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

namespace Request\Exception;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Phlexa\Request\Exception\BadRequest;

/**
 * Class BadRequestExceptionTest
 *
 * @package Request\Exception
 */
class BadRequestExceptionTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $exception = new BadRequest('This was a bad request');

        $this->assertTrue($exception instanceof RuntimeException);
    }
}
