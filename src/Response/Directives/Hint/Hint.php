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

namespace Phlexa\Response\Directives\Hint;

use Phlexa\Response\Directives\DirectivesInterface;

/**
 * Class Hint
 *
 * @package Phlexa\Response\Directives\Hint
 */
class Hint implements DirectivesInterface
{
    /** Type of directive */
    public const DIRECTIVE_TYPE = 'Hint';

    /** @var string */
    private $text;

    /**
     * Hint constructor.
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * Get the directive type
     *
     * @return string
     */
    public function getType(): string
    {
        return self::DIRECTIVE_TYPE;
    }

    /**
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => self::DIRECTIVE_TYPE,
            'hint' => [
                'type' => 'PlainText',
                'text' => $this->text,
            ],
        ];
    }
}
