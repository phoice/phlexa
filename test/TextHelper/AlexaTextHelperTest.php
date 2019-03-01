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

namespace PhlexaTest\TextHelper;

use Phlexa\TextHelper\TextHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class AlexaTextHelperTest
 *
 * @package PhlexaTest\TextHelper
 */
class AlexaTextHelperTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithTexts()
    {
        $texts = [
            'en-US' => [
                'launchTitle'     => 'another launch title',
                'launchMessage'   => 'another launch message',
                'repromptMessage' => 'another reprompt message',
                'helpTitle'       => 'another help title',
                'helpMessage'     => 'another help message',
                'stopTitle'       => 'another stop title',
                'stopMessage'     => 'another stop message',
                'cancelTitle'     => 'another cancel title',
                'cancelMessage'   => 'another cancel message',
            ],
        ];

        $textHelper = new TextHelper($texts);

        $this->assertEquals(
            'another launch title',
            $textHelper->getLaunchTitle()
        );
        $this->assertEquals(
            'another launch message',
            $textHelper->getLaunchMessage()
        );
        $this->assertEquals(
            'another reprompt message',
            $textHelper->getRepromptMessage()
        );
        $this->assertEquals(
            'another help title',
            $textHelper->getHelpTitle()
        );
        $this->assertEquals(
            'another help message',
            $textHelper->getHelpMessage()
        );
        $this->assertEquals(
            'another stop title',
            $textHelper->getStopTitle()
        );
        $this->assertEquals(
            'another stop message',
            $textHelper->getStopMessage()
        );
        $this->assertEquals(
            'another cancel title',
            $textHelper->getCancelTitle()
        );
        $this->assertEquals(
            'another cancel message',
            $textHelper->getCancelMessage()
        );
    }

    /**
     *
     */
    public function testInstantiationWithGermanLocale()
    {
        $texts = [
            'en-US' => [
                'launchTitle'     => 'another launch title',
                'launchMessage'   => 'another launch message',
                'repromptMessage' => 'another reprompt message',
                'helpTitle'       => 'another help title',
                'helpMessage'     => 'another help message',
                'stopTitle'       => 'another stop title',
                'stopMessage'     => 'another stop message',
                'cancelTitle'     => 'another cancel title',
                'cancelMessage'   => 'another cancel message',
            ],
            'de-DE' => [
                'launchTitle'     => 'deutscher Launch Titel',
                'launchMessage'   => 'deutsche Launch Nachricht',
                'repromptMessage' => 'deutsche Reprompt Nachricht',
                'helpTitle'       => 'deutscher Hilfe Titel',
                'helpMessage'     => 'deutsche Hilfe Nachricht',
                'stopTitle'       => 'deutscher Stop Titel',
                'stopMessage'     => 'deutsche Stop Nachricht',
                'cancelTitle'     => 'deutscher Abbrechen Titel',
                'cancelMessage'   => 'deutsche Abbrechen Nachricht',
            ],
        ];

        $textHelper = new TextHelper($texts);
        $textHelper->setLocale('de-DE');

        $this->assertEquals(
            'deutscher Launch Titel',
            $textHelper->getLaunchTitle()
        );
        $this->assertEquals(
            'deutsche Launch Nachricht',
            $textHelper->getLaunchMessage()
        );
        $this->assertEquals(
            'deutsche Reprompt Nachricht',
            $textHelper->getRepromptMessage()
        );
        $this->assertEquals(
            'deutscher Hilfe Titel',
            $textHelper->getHelpTitle()
        );
        $this->assertEquals(
            'deutsche Hilfe Nachricht',
            $textHelper->getHelpMessage()
        );
        $this->assertEquals(
            'deutscher Stop Titel',
            $textHelper->getStopTitle()
        );
        $this->assertEquals(
            'deutsche Stop Nachricht',
            $textHelper->getStopMessage()
        );
        $this->assertEquals(
            'deutscher Abbrechen Titel',
            $textHelper->getCancelTitle()
        );
        $this->assertEquals(
            'deutsche Abbrechen Nachricht',
            $textHelper->getCancelMessage()
        );
    }

    /**
     *
     */
    public function testInstantiationWithRandomTexts()
    {
        $texts = [
            'de-DE' => [
                'launchTitle'     => [
                    'Launch Titel 1',
                    'Launch Titel 2',
                    'Launch Titel 3',
                ],
                'launchMessage'   => [
                    'Launch Nachricht 1',
                    'Launch Nachricht 2',
                    'Launch Nachricht 3',
                ],
                'repromptMessage' => [
                    'Reprompt Nachricht 1',
                    'Reprompt Nachricht 2',
                    'Reprompt Nachricht 3',
                ],
                'helpTitle'       => [
                    'Hilfe Titel 1',
                    'Hilfe Titel 2',
                    'Hilfe Titel 3',
                ],
                'helpMessage'     => [
                    'Hilfe Nachricht 1',
                    'Hilfe Nachricht 2',
                    'Hilfe Nachricht 3',
                ],
                'stopTitle'       => [
                    'Stop Titel 1',
                    'Stop Titel 2',
                    'Stop Titel 3',
                ],
                'stopMessage'     => [
                    'Stop Nachricht 1',
                    'Stop Nachricht 2',
                    'Stop Nachricht 3',
                ],
                'cancelTitle'     => [
                    'Abbrechen Titel 1',
                    'Abbrechen Titel 2',
                    'Abbrechen Titel 3',
                ],
                'cancelMessage'   => [
                    'Abbrechen Nachricht 1',
                    'Abbrechen Nachricht 2',
                    'Abbrechen Nachricht 3',
                ],
            ],
        ];

        $textHelper = new TextHelper($texts);
        $textHelper->setLocale('de-DE');

        $this->assertTrue(
            in_array($textHelper->getLaunchTitle(), $texts['de-DE']['launchTitle'])
        );

        $this->assertTrue(
            in_array($textHelper->getLaunchMessage(), $texts['de-DE']['launchMessage'])
        );

        $this->assertTrue(
            in_array($textHelper->getRepromptMessage(), $texts['de-DE']['repromptMessage'])
        );

        $this->assertTrue(
            in_array($textHelper->getHelpTitle(), $texts['de-DE']['helpTitle'])
        );

        $this->assertTrue(
            in_array($textHelper->getHelpMessage(), $texts['de-DE']['helpMessage'])
        );

        $this->assertTrue(
            in_array($textHelper->getStopTitle(), $texts['de-DE']['stopTitle'])
        );

        $this->assertTrue(
            in_array($textHelper->getStopMessage(), $texts['de-DE']['stopMessage'])
        );

        $this->assertTrue(
            in_array($textHelper->getCancelTitle(), $texts['de-DE']['cancelTitle'])
        );

        $this->assertTrue(
            in_array($textHelper->getCancelMessage(), $texts['de-DE']['cancelMessage'])
        );
    }

    /**
     *
     */
    public function testInstantiationWithoutTexts()
    {
        $textHelper = new TextHelper();

        $this->assertEquals('launchTitle', $textHelper->getLaunchTitle());
        $this->assertEquals('launchMessage', $textHelper->getLaunchMessage());
        $this->assertEquals('repromptMessage', $textHelper->getRepromptMessage());
        $this->assertEquals('helpTitle', $textHelper->getHelpTitle());
        $this->assertEquals('helpMessage', $textHelper->getHelpMessage());
        $this->assertEquals('stopTitle', $textHelper->getStopTitle());
        $this->assertEquals('stopMessage', $textHelper->getStopMessage());
        $this->assertEquals('cancelTitle', $textHelper->getCancelTitle());
        $this->assertEquals('cancelMessage', $textHelper->getCancelMessage());
    }

    /**
     *
     */
    public function testUnknownTexts()
    {
        $textHelper = new TextHelper();

        $this->assertEquals('unknownTitle', $textHelper->getUnknownTitle());
    }
}
