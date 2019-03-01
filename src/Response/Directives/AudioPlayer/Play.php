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

namespace Phlexa\Response\Directives\AudioPlayer;

use Phlexa\Response\Directives\DirectivesInterface;
use Phlexa\Response\Directives\Display\Image;

/**
 * Class Play
 *
 * @package Phlexa\Response\Directives\AudioPlayer
 */
class Play implements DirectivesInterface
{
    public const PLAY_BEHAVIOR_REPLACE_ALL      = 'REPLACE_ALL';
    public const PLAY_BEHAVIOR_ENQUEUE          = 'ENQUEUE';
    public const PLAY_BEHAVIOR_REPLACE_ENQUEUED = 'REPLACE_ENQUEUED';

    /** @var string */
    private $type = 'AudioPlayer.Play';

    /** @var string */
    protected $playBehavior;

    /** @var string */
    protected $url;

    /** @var string */
    protected $token;

    /** @var string */
    protected $expectedPreviousToken;

    /** @var int */
    protected $offsetInMilliseconds = 0;

    /** @var string */
    private $title;

    /** @var string */
    private $subTitle;

    /** @var Image */
    private $art;

    /** @var Image */
    private $backgroundImage;

    /**
     * Play constructor.
     *
     * @param string $playBehavior
     * @param string $url
     * @param string $token
     * @param string $expectedPreviousToken
     * @param int    $offsetInMilliseconds
     */
    public function __construct(
        string $playBehavior,
        string $url,
        string $token,
        string $expectedPreviousToken = null,
        int $offsetInMilliseconds = null
    ) {
        $this->setPlayBehavior($playBehavior);
        $this->setUrl($url);
        $this->setToken($token);

        if ($expectedPreviousToken) {
            $this->setExpectedPreviousToken($expectedPreviousToken);
        }

        if ($offsetInMilliseconds) {
            $this->setOffsetInMilliseconds($offsetInMilliseconds);
        }
    }

    /**
     * Get the directive type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string      $title
     * @param string|null $subTitle
     * @param Image|null  $art
     * @param Image|null  $backgroundImage
     */
    public function setMetaData(
        string $title,
        string $subTitle = null,
        Image $art = null,
        Image $backgroundImage = null
    ): void {
        $this->setTitle($title);

        if ($subTitle) {
            $this->setSubTitle($subTitle);
        }

        if ($art) {
            $this->setArt($art);
        }

        if ($backgroundImage) {
            $this->setBackgroundImage($backgroundImage);
        }
    }

    /**
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'type'         => $this->type,
            'playBehavior' => $this->playBehavior,
            'audioItem'    => [
                'stream' => [
                    'url'                   => $this->url,
                    'token'                 => $this->token,
                    'expectedPreviousToken' => $this->expectedPreviousToken,
                    'offsetInMilliseconds'  => $this->offsetInMilliseconds,
                ],
            ],
        ];

        if ($this->title) {
            $data['audioItem']['metadata'] = [
                'title' => $this->title,
            ];

            if ($this->subTitle) {
                $data['audioItem']['metadata']['subtitle'] = $this->subTitle;
            }

            if ($this->art) {
                $data['audioItem']['metadata']['art'] = $this->art->toArray();
            }

            if ($this->backgroundImage) {
                $data['audioItem']['metadata']['backgroundImage'] = $this->backgroundImage->toArray();
            }
        }

        return $data;
    }

    /**
     * @param string $playBehavior
     */
    private function setPlayBehavior(string $playBehavior)
    {
        switch ($playBehavior) {
            case self::PLAY_BEHAVIOR_REPLACE_ALL:
            case self::PLAY_BEHAVIOR_ENQUEUE:
            case self::PLAY_BEHAVIOR_REPLACE_ENQUEUED:
                $this->playBehavior = $playBehavior;
                break;

            default:
                $this->playBehavior = self::PLAY_BEHAVIOR_REPLACE_ALL;
        }
    }

    /**
     * @param string $url
     */
    private function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param string $token
     */
    private function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @param string $expectedPreviousToken
     */
    private function setExpectedPreviousToken(string $expectedPreviousToken)
    {
        $this->expectedPreviousToken = $expectedPreviousToken;
    }

    /**
     * @param int $offsetInMilliseconds
     */
    private function setOffsetInMilliseconds(int $offsetInMilliseconds)
    {
        $this->offsetInMilliseconds = $offsetInMilliseconds;
    }

    /**
     * @param string $title
     */
    private function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $subTitle
     */
    private function setSubTitle(string $subTitle): void
    {
        $this->subTitle = $subTitle;
    }

    /**
     * @param Image $art
     */
    private function setArt(Image $art): void
    {
        $this->art = $art;
    }

    /**
     * @param Image $backgroundImage
     */
    private function setBackgroundImage(Image $backgroundImage): void
    {
        $this->backgroundImage = $backgroundImage;
    }
}
