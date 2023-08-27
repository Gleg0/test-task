<?php

namespace App\Model;

class ContributorListResponse
{
    /**
     * @var ContributorListItem[]
     */
    private  array $items;

    /**
     * @return  ContributorListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param ContributorListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}
