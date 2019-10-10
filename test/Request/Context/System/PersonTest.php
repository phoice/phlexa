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

namespace PhlexaTest\Request\Context\System;

use Phlexa\Request\Context\System\Person;
use PHPUnit\Framework\TestCase;

/**
 * Class PersonTest
 *
 * @package PhlexaTest\Request\Context\System
 */
class PersonTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $person = new Person('personId');

        $expected = 'personId';

        $this->assertEquals($expected, $person->getPersonId());
        $this->assertNull($person->getAccessToken());
    }

    /**
     *
     */
    public function testAccessToken()
    {
        $person = new Person('personId');
        $person->setAccessToken('123456');

        $expected = '123456';

        $this->assertEquals($expected, $person->getAccessToken());
    }
}
