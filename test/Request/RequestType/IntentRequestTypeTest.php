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

namespace PhlexaTest\Request\RequestType;

use Phlexa\Request\RequestType\Intent\Intent;
use Phlexa\Request\RequestType\IntentRequestType;
use PHPUnit\Framework\TestCase;

/**
 * Class IntentRequestTypeTest
 *
 * @package PhlexaTest\Request\RequestType
 */
class IntentRequestTypeTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $slots = [
            'foo' => [
                'name'  => 'foo',
                'value' => 'bar',
            ],
        ];

        $intent = new Intent('name', $slots);

        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';

        $intentRequest = new IntentRequestType(
            $requestId,
            $timestamp,
            $locale,
            $intent
        );

        $this->assertEquals('IntentRequest', $intentRequest->getType());
        $this->assertEquals($requestId, $intentRequest->getRequestId());
        $this->assertEquals($timestamp, $intentRequest->getTimestamp());
        $this->assertEquals($locale, $intentRequest->getLocale());
        $this->assertEquals($intent, $intentRequest->getIntent());
    }
}
