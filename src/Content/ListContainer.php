<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Meike Ziesecke <m.ziesecke@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

namespace Phlexa\Content;

/**
 * Class ListContainer
 *
 * @package Phlexa\Content
 */
class ListContainer extends BodyContainer
{
    /** @var ListItemContainer[] */
    private $listItems = [];

    /**
     * @return ListItemContainer[]
     */
    public function getListItems(): array
    {
        return $this->listItems;
    }

    /**
     * @param ListItemContainer[] $listItems
     */
    public function setListItems(array $listItems): void
    {
        $this->listItems = $listItems;
    }

    /**
     * @return bool
     */
    public function hastListItems(): bool
    {
        return !empty($this->listItems);
    }
}
