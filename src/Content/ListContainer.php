<?php


namespace Phlexa\Content;


/**
 * Class ListContainer
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