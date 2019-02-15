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

namespace Phlexa\Response\Directives\Alexa\Presentation\APL\Document;

use Phlexa\Response\Directives\DirectivesInterface;

/**
 * Class APL
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APL\Document
 */
class APL implements DirectivesInterface
{
    /** Type of directive */
    public const DIRECTIVE_TYPE = 'APL';

    /** @var string */
    private $version = '1.0';

    /**
     * @var string
     */
    private $theme;

    /**
     * @var array
     */
    private $import = [];

    /**
     * @var array
     */
    private $resources = [];

    /**
     * @var array
     */
    private $styles = [];

    /**
     * @var array
     */
    private $layouts = [];

    /**
     * @var array
     */
    private $mainTemplate = [];

    /**
     * APL constructor.
     *
     * @param array  $import
     * @param array  $resources
     * @param array  $styles
     * @param array  $layouts
     * @param array  $mainTemplate
     * @param string $theme
     */
    public function __construct(
        array $import,
        array $resources,
        array $styles,
        array $layouts,
        array $mainTemplate,
        string $theme = 'dark'
    ) {
        $this->import       = $import;
        $this->theme        = $theme;
        $this->resources    = $resources;
        $this->styles       = $styles;
        $this->layouts      = $layouts;
        $this->mainTemplate = $mainTemplate;
    }

    /**
     * @param $aplJson
     *
     * @return APL
     */
    public static function createFromString(string $aplJson): APL
    {
        $aplData = json_decode($aplJson, true);

        $import       = $aplData['import'] ?? [];
        $theme        = $aplData['theme'] ?? 'dark';
        $resources    = $aplData['resources'] ?? [];
        $styles       = $aplData['styles'] ?? [];
        $layouts      = $aplData['layouts'] ?? [];
        $mainTemplate = $aplData['mainTemplate'] ?? [];

        return new APL($import, $resources, $styles, $layouts, $mainTemplate, $theme);
    }

    /**
     * @param string $aplFile
     *
     * @return APL
     */
    public static function createFromFile(string $aplFile): APL
    {
        $aplJson = file_get_contents($aplFile);

        return self::createFromString($aplJson);
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
            'theme'        => $this->theme,
            'import'       => $this->import,
            'resources'    => $this->resources,
            'styles'       => $this->styles,
            'layouts'      => $this->layouts,
            'mainTemplate' => $this->mainTemplate,
        ];

        return $data;
    }
}
