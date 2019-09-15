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

namespace PhlexaTest\Configuration;

use Phlexa\Configuration\SkillConfiguration;
use PHPUnit\Framework\TestCase;

/**
 * Class SkillConfigurationTest
 *
 * @package PhlexaTest\Configuration
 */
class SkillConfigurationTest extends TestCase
{
    /**
     *
     */
    public function testSetName()
    {
        $name = 'foo';

        $skillConfiguration = new SkillConfiguration();
        $skillConfiguration->setName($name);

        $this->assertEquals($name, $skillConfiguration->getName());
    }

    /**
     *
     */
    public function testSetConfig()
    {
        $config = [
            'applicationId'             => 'amzn1.ask.skill.place-your-skill-id-here',
            'skillTitle'                => 'Skill Title',
            'applicationClass'          => 'ApplicationClass',
            'textHelperClass'           => 'TextHelperClass',
            'smallIconImage'            => 'https://www.phoice.tech//cards/icon-480x480.png',
            'largeIconImage'            => 'https://www.phoice.tech//cards/icon-800x800.png',
            'smallFrontImage'           => 'https://www.phoice.tech//cards/hello-480x480.png',
            'largeFrontImage'           => 'https://www.phoice.tech//cards/hello-800x800.png',
            'roundBackgroundImage'      => 'https://www.phoice.tech//cards/hello-480x480.png',
            'mediumBackgroundImage'     => 'https://www.phoice.tech//cards/hello-1024x600.png',
            'largeBackgroundImage'      => 'https://www.phoice.tech//cards/hello-1280x800.png',
            'extraLargeBackgroundImage' => 'https://www.phoice.tech//cards/hello-1920x1080.png',
            'imageTitle'                => 'Background Image Title',
            'sessionDefaults'           => [
                'foo' => 'bar',
                'bar' => 'foo',
            ],
            'intents'                   => [
                'aliases' => [
                    'foo' => 'bar',
                ],

                'factories' => [
                    'foo' => 'bar',
                ],
            ],
            'texts'                     => [
                'de-DE' => [
                    'foo' => 'bar'
                ],
                'en-UK' => [
                    'foo' => 'bar'
                ],
                'en-US' => [
                    'foo' => 'bar'
                ],
            ],
            'customData'                => [
                'foo' => 'bar'
            ],
            'aplDocuments'     => ['normal-body' => '{"type": "APL"}'],
        ];

        $skillConfiguration = new SkillConfiguration();
        $skillConfiguration->setConfig($config);

        $this->assertEquals($config['applicationId'], $skillConfiguration->getApplicationId());
        $this->assertEquals($config['skillTitle'], $skillConfiguration->getSkillTitle());
        $this->assertEquals($config['applicationClass'], $skillConfiguration->getApplicationClass());
        $this->assertEquals($config['textHelperClass'], $skillConfiguration->getTextHelperClass());
        $this->assertEquals($config['sessionDefaults'], $skillConfiguration->getSessionDefaults());
        $this->assertEquals($config['smallIconImage'], $skillConfiguration->getSmallIconImage());
        $this->assertEquals($config['largeIconImage'], $skillConfiguration->getLargeIconImage());
        $this->assertEquals($config['smallFrontImage'], $skillConfiguration->getSmallFrontImage());
        $this->assertEquals($config['largeFrontImage'], $skillConfiguration->getLargeFrontImage());
        $this->assertEquals($config['roundBackgroundImage'], $skillConfiguration->getRoundBackgroundImage());
        $this->assertEquals($config['mediumBackgroundImage'], $skillConfiguration->getMediumBackgroundImage());
        $this->assertEquals($config['largeBackgroundImage'], $skillConfiguration->getLargeBackgroundImage());
        $this->assertEquals($config['extraLargeBackgroundImage'], $skillConfiguration->getExtraLargeBackgroundImage());
        $this->assertEquals($config['imageTitle'], $skillConfiguration->getImageTitle());
        $this->assertEquals($config['intents'], $skillConfiguration->getIntents());
        $this->assertEquals($config['texts'], $skillConfiguration->getTexts());
        $this->assertEquals($config['customData'], $skillConfiguration->getCustomData());
        $this->assertEquals($config['aplDocuments'], $skillConfiguration->getAplDocuments());
    }
}
