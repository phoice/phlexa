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

namespace PhlexaTest\Response\Card;

use Phlexa\Response\Card\AskForPermissionsConsent;
use PHPUnit\Framework\TestCase;

/**
 * Class AskForPermissionsConsentTest
 *
 * @package PhlexaTest\Response\Card
 */
class AskForPermissionsConsentTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationRemindersSkillReadWrite(): void
    {
        $card = new AskForPermissionsConsent(
            [AskForPermissionsConsent::ALEXA_ALERTS_REMINDERS_SKILL_READWRITE]
        );

        $expected = [
            'type'        => 'AskForPermissionsConsent',
            'permissions' => [AskForPermissionsConsent::ALEXA_ALERTS_REMINDERS_SKILL_READWRITE],
        ];

        $this->assertEquals($expected, $card->toArray());
    }

    /**
     *
     */
    public function testInstantiationDeviceAllAddress(): void
    {
        $card = new AskForPermissionsConsent(
            [AskForPermissionsConsent::READ_ALEXA_DEVICE_ALL_ADDRESS]
        );

        $expected = [
            'type'        => 'AskForPermissionsConsent',
            'permissions' => [AskForPermissionsConsent::READ_ALEXA_DEVICE_ALL_ADDRESS],
        ];

        $this->assertEquals($expected, $card->toArray());
    }
}
