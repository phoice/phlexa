<?php
namespace Phlexa\Response\Directives\Alexa\Presentation\APLA;

use Phlexa\Response\Directives\Alexa\Presentation\APLA\Document\APLA;
use Phlexa\Response\Directives\DirectivesInterface;

class RenderDocument implements DirectivesInterface
{
    /** Type of directive */
    public const DIRECTIVE_TYPE = 'Alexa.Presentation.APLA.RenderDocument';

    /** @var string */
    /*private $version = '0.2';*/

    /** @var APLA */
    private $document;

    /** @var string */
    private $token;

    /** @var array */
    private $datasources = [];

    /**
     * RenderDocument constructor.
     *
     * @param APLA    $document
     * @param string $token
     * @param array  $datasources
     */
    public function __construct(APLA $document, string $token, array $datasources)
    {
        $this->document    = $document;
        $this->token       = $token;
        $this->datasources = $datasources;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::DIRECTIVE_TYPE;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'type'        => $this->getType(),
            'document'    => $this->document->toArray(),
            'token'       => $this->token,
            'datasources' => $this->datasources,
        ];

        return $data;
    }

}