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

namespace PhlexaTest\Configuration;

use PHPUnit\Framework\TestCase;
use Phlexa\Configuration\SkillConfiguration;

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
            'applicationId'    => 'amzn1.ask.skill.place-your-skill-id-here',
            'applicationClass' => 'ApplicationClass',
            'textHelperClass'  => 'TextHelperClass',
            'smallImageUrl'    => 'https://www.phoice.tech//cards/hello-480x480.png',
            'largeImageUrl'    => 'https://www.phoice.tech//cards/hello-800x800.png',
            'sessionDefaults'  => [
                'foo' => 'bar',
                'bar' => 'foo',
            ],
            'intents'          => [
                'aliases' => [
                    'foo' => 'bar',
                ],

                'factories' => [
                    'foo' => 'bar',
                ],
            ],
            'texts'            => [
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
        ];

        $skillConfiguration = new SkillConfiguration();
        $skillConfiguration->setConfig($config);

        $this->assertEquals($config['applicationId'], $skillConfiguration->getApplicationId());
        $this->assertEquals($config['applicationClass'], $skillConfiguration->getApplicationClass());
        $this->assertEquals($config['textHelperClass'], $skillConfiguration->getTextHelperClass());
        $this->assertEquals($config['sessionDefaults'], $skillConfiguration->getSessionDefaults());
        $this->assertEquals($config['smallImageUrl'], $skillConfiguration->getSmallImageUrl());
        $this->assertEquals($config['largeImageUrl'], $skillConfiguration->getLargeImageUrl());
        $this->assertEquals($config['intents'], $skillConfiguration->getIntents());
        $this->assertEquals($config['texts'], $skillConfiguration->getTexts());
    }
}
