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
    private $version = '0.9';

    /** @var array */
    private $mainTemplate = [];

    /**
     * APLA constructor.
     *
     * @param array $mainTemplate
     */
    public function __construct(
        array $mainTemplate,
        string $version ='0.9'
    ) {
        $this->mainTemplate = $mainTemplate;
        $this->version = $version;
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
        $version = $aplaData['version'] ?? '0.9';

        return new APLA($mainTemplate, $version);
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
            'mainTemplate' => $this->mainTemplate,
        ];

        return $data;
    }
}
