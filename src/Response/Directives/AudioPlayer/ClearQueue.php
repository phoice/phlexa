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

/**
 * Class ClearQueue
 *
 * @package Phlexa\Response\Directives\AudioPlayer
 */
class ClearQueue implements DirectivesInterface
{
    public const CLEAR_BEHAVIOR_CLEAR_ENQUEUED = 'CLEAR_ENQUEUED';
    public const CLEAR_BEHAVIOR_CLEAR_ALL      = 'CLEAR_ALL';

    /** @var string */
    private $type = 'AudioPlayer.ClearQueue';

    /** @var string */
    protected $clearBehavior;

    /**
     * ClearQueue constructor.
     *
     * @param string $clearBehavior
     */
    public function __construct($clearBehavior)
    {
        $this->setClearBehavior($clearBehavior);
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
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'          => $this->type,
            'clearBehavior' => $this->clearBehavior,
        ];
    }

    /**
     * @param $clearBehavior
     */
    private function setClearBehavior($clearBehavior)
    {
        $this->clearBehavior = $clearBehavior;

        switch ($clearBehavior) {
            case self::CLEAR_BEHAVIOR_CLEAR_ALL:
            case self::CLEAR_BEHAVIOR_CLEAR_ENQUEUED:
                $this->clearBehavior = $clearBehavior;
                break;

            default:
                $this->clearBehavior = self::CLEAR_BEHAVIOR_CLEAR_ALL;
        }
    }
}
