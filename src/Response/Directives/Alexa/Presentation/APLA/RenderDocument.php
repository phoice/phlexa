<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Meike Ziesecke <m.ziesecke@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

declare(strict_types=1);

namespace Phlexa\Response\Directives\Alexa\Presentation\APLA;

use Phlexa\Response\Directives\Alexa\Presentation\APLA\Document\APLA;
use Phlexa\Response\Directives\DirectivesInterface;

/**
 * Class RenderDocument
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APLA
 */
class RenderDocument implements DirectivesInterface
{
    /** Type of directive */
    public const DIRECTIVE_TYPE = 'Alexa.Presentation.APLA.RenderDocument';

    /** @var APLA */
    private $document;

    /** @var string */
    private $token;

    /** @var array */
    private $datasources = [];

    /**
     * RenderDocument constructor.
     *
     * @param APLA   $document
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
