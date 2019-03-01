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

namespace Request\Exception;

use Phlexa\Request\Exception\BadRequest;
use PHPUnit\Framework\TestCase;
use RuntimeException;

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
