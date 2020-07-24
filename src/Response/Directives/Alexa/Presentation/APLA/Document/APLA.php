<?php

namespace Phlexa\Response\Directives\Alexa\Presentation\APLA\Document;

use Phlexa\Response\Directives\DirectivesInterface;

class APLA implements DirectivesInterface
{
    /** Type of directive */
    public const DIRECTIVE_TYPE = 'APLA';

    /** @var string */
    private $version = '0.8';
    
    /**
     * @var array
     */
    private $mainTemplate = [];
    


    /**
     * APLA constructor.
     *
     * @param array  $mainTemplate
     */
    public function __construct(
        array $mainTemplate
    ) {
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

        return new APLA($mainTemplate);
    }

    /**
     * @param string $aplFile
     *
     * @return APL
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