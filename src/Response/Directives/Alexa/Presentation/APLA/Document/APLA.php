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

namespace Phlexa\Response\Directives\Alexa\Presentation\APLA\Document;

use Phlexa\Response\Directives\DirectivesInterface;

/**
 * Class APLA
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APLA\Document
 */
class APLA implements DirectivesInterface
{
    /** Type of directive */
    public const DIRECTIVE_TYPE = 'APLA';

    /** @var string */
    private $version = '0.91';

    /** @var array */
    private $mainTemplate = [];

    /** @var array */
    private $resources = [];

    /**
     * APLA constructor.
     *
     * @param array $mainTemplate
     */
    public function __construct(
        array $resources,
        array $mainTemplate
    ) {
        $this->resources = $resources;
        $this->mainTemplate = $mainTemplate;
    }

    /**
     * @param $aplaJson
     *
     * @return APLA
     */
    public static function createFromString(string $aplaJson): APLA
    {
        $aplaData = json_decode($aplaJson, true);

        $mainTemplate = $aplaData['mainTemplate'] ?? [];
        $resources = $aplaData['resources'] ?? [];

        return new APLA($resources, $mainTemplate);
    }

    /**
     * @param string $aplaFile
     *
     * @return APLA
     */
    public static function createFromFile(string $aplaFile): APLA
    {
        $aplaJson = file_get_contents($aplaFile);

        return self::createFromString($aplaJson);
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
            'type'         => $this->getType(),
            'version'      => $this->version,
            'resources'    => $this->resources,
            'mainTemplate' => $this->mainTemplate,
        ];

        return $data;
    }
}
