<?php
namespace Phlexa\Request\Context\Viewport;

/**
 * Class Video
 */
class Video implements VideoInterface
{
    /**
     * @var array
     */
    private $codecs = [];

    /**
     * @return array
     */
    public function getCodecs(): array
    {
        return $this->codecs;
    }

    /**
     * @param array $codecs
     */
    public function setCodecs(array $codecs): void
    {
        $this->codecs = $codecs;
    }

}