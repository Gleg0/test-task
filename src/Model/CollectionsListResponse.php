<?php
namespace App\Model;
class CollectionsListResponse{
    /**
     * @var CollectionsListItem[]
     */
    private  array $items;

    /**
     * @return  CollectionsListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param CollectionsListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
