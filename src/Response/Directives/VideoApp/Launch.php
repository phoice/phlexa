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

namespace Phlexa\Response\Directives\VideoApp;

use Phlexa\Response\Directives\DirectivesInterface;

/**
 * Class Launch
 *
 * @package Phlexa\Response\Directives\VideoApp
 */
class Launch implements DirectivesInterface
{
    /** @var string */
    private $type = 'VideoApp.Launch';

    /** @var string */
    protected $source;

    /** @var string */
    protected $title;

    /** @var string */
    protected $subtitle;

    /**
     * Launch constructor.
     *
     * @param string $source
     * @param string $title
     * @param string $subtitle
     */
    public function __construct(string $source, string $title = null, string $subtitle = null)
    {
        $this->setSource($source);

        if ($title) {
            $this->setTitle($title);
        }

        if ($subtitle) {
            $this->setSubtitle($subtitle);
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
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'type'      => $this->type,
            'videoItem' => [
                'source' => $this->source,
            ],
        ];

        if (!empty($this->title)) {
            $data['videoItem']['metadata'] = [
                'title' => $this->title,
            ];

            if (!empty($this->subtitle)) {
                $data['videoItem']['metadata']['subtitle'] = $this->subtitle;
            }
        }

        return $data;
    }

    /**
     * @param string $source
     */
    private function setSource(string $source)
    {
        $this->source = $source;
    }

    /**
     * @param string $title
     */
    private function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param string $subtitle
     */
    private function setSubtitle(string $subtitle)
    {
        $this->subtitle = $subtitle;
    }
}
