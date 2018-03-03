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

namespace Phlexa\Response\Directives\Display;

use Phlexa\Response\Directives\DirectivesInterface;

/**
 * Class RenderTemplate
 *
 * @package Phlexa\Response\Directives\Display
 */
class RenderTemplate implements DirectivesInterface
{
    /** Type of directive */
    const DIRECTIVE_TYPE = 'Display.RenderTemplate';

    /** All template types */
    const TYPE_LIST_TEMPLATE_1 = 'ListTemplate1';
    const TYPE_LIST_TEMPLATE_2 = 'ListTemplate2';
    const TYPE_BODY_TEMPLATE_1 = 'BodyTemplate1';
    const TYPE_BODY_TEMPLATE_2 = 'BodyTemplate2';
    const TYPE_BODY_TEMPLATE_3 = 'BodyTemplate3';
    const TYPE_BODY_TEMPLATE_6 = 'BodyTemplate6';

    /** Allowed template types */
    const ALLOWED_TYPES
        = [
            self::TYPE_LIST_TEMPLATE_1, self::TYPE_LIST_TEMPLATE_2, self::TYPE_BODY_TEMPLATE_1,
            self::TYPE_BODY_TEMPLATE_2, self::TYPE_BODY_TEMPLATE_3, self::TYPE_BODY_TEMPLATE_6,
        ];

    /** All back button types */
    const BACK_BUTTON_HIDDEN = 'HIDDEN';
    const BACK_BUTTON_VISIBLE = 'VISIBLE';

    /** Allowed template types */
    const ALLOWED_BACK_BUTTONS = [self::BACK_BUTTON_HIDDEN, self::BACK_BUTTON_VISIBLE,];

    /** Maximum length of title attribute */
    const MAX_TITLE_LENGTH = 200;

    /** @var string */
    private $type;

    /** @var string */
    private $token;

    /** @var TextContent */
    private $textContent;

    /** @var string */
    private $backButton = self::BACK_BUTTON_HIDDEN;

    /** @var Image */
    private $backgroundImage;

    /** @var string */
    private $title;

    /** @var Image */
    private $image;

    /**
     * RenderTemplate constructor.
     *
     * @param string      $type
     * @param string      $token
     * @param TextContent $textContent
     */
    public function __construct(string $type, string $token, TextContent $textContent)
    {
        if (!in_array($type, self::ALLOWED_TYPES)) {
            $type = self::TYPE_BODY_TEMPLATE_1;
        }

        $this->type        = $type;
        $this->token       = $token;
        $this->textContent = $textContent;
    }

    /**
     * @param string $backButton
     */
    public function setBackButton(string $backButton)
    {
        if (in_array($backButton, self::ALLOWED_BACK_BUTTONS)) {
            $this->backButton = $backButton;
        }
    }

    /**
     * @param Image $backgroundImage
     */
    public function setBackgroundImage(Image $backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        if (strlen($title) > self::MAX_TITLE_LENGTH) {
            $title = substr($title, 0, self::MAX_TITLE_LENGTH);
        }

        $this->title = $title;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
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
        $data = [
            'type'     => $this->getType(),
            'template' => [
                'type'        => $this->type,
                'token'       => $this->token,
                'backButton'  => $this->backButton,
                'textContent' => $this->textContent->toArray(),
            ],
        ];

        if ($this->backgroundImage) {
            $data['template']['backgroundImage'] = $this->backgroundImage->toArray();
        }

        if ($this->title) {
            $data['template']['title'] = $this->title;
        }

        if ($this->image) {
            $data['template']['image'] = $this->image->toArray();
        }

        return $data;
    }
}
