<?php

namespace App\Model;
class ContributorListItem
{
    private int $id;
    private string $collection;
    private string $user_name;
    private int $amount;

    /**
     * @param int $id
     * @param string $collection
     * @param string $user_name
     * @param int $amount
     */
    public function __construct(int $id, string $collection, string $user_name, int $amount)
    {
        $this->id = $id;
        $this->collection = $collection;
        $this->user_name = $user_name;
        $this->amount = $amount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCollection(): string
    {
        return $this->collection;
    }

    public function setCollection(string $collection): void
    {
        $this->collection = $collection;
    }

    public function getUserName(): string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): void
    {
        $this->user_name = $user_name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }
}
