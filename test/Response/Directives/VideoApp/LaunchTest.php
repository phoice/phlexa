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

namespace Response\Directives\VideoApp;

use Phlexa\Response\Directives\VideoApp\Launch;
use PHPUnit\Framework\TestCase;

/**
 * Class LaunchTest
 *
 * @package Response\Directives\VideoApp
 */
class LaunchTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithMetaData()
    {
        $directive = new Launch(
            'https:/www.test.de/video.mp4', 'title', 'subtitle'
        );

        $expected = [
            'type'      => 'VideoApp.Launch',
            'videoItem' => [
                'source'   => 'https:/www.test.de/video.mp4',
                'metadata' => [
                    'title'    => 'title',
                    'subtitle' => 'subtitle',
                ],
            ],
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('VideoApp.Launch', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationWithoutMetaData()
    {
        $directive = new Launch(
            'https:/www.test.de/video.mp4'
        );

        $expected = [
            'type'      => 'VideoApp.Launch',
            'videoItem' => [
                'source' => 'https:/www.test.de/video.mp4',
            ],
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('VideoApp.Launch', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationWithoutSubtitle()
    {
        $directive = new Launch(
            'https:/www.test.de/video.mp4', 'title'
        );

        $expected = [
            'type'      => 'VideoApp.Launch',
            'videoItem' => [
                'source'   => 'https:/www.test.de/video.mp4',
                'metadata' => [
                    'title' => 'title',
                ],
            ],
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('VideoApp.Launch', $directive->getType());
    }
}