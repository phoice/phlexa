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

namespace PhlexaTest\Request\RequestType\Cause;

use Phlexa\Request\RequestType\Cause\Cause;
use PHPUnit\Framework\TestCase;

/**
 * Class CauseTest
 *
 * @package PhlexaTest\Request\Session
 */
class CauseTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $cause = new Cause('requestId');

        $this->assertEquals('requestId', $cause->getRequestId());
    }
}
