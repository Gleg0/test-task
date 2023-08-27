<?php

namespace App\Model;
class CollectionsListItem
{
    private int $id;
    private string $title;
    private string $description;
    private int $target_amount;
    private \DateTimeImmutable $created_at;
    private string $link;

    public function __construct(int $id, string $title, string $description, int $target_amount, \DateTimeImmutable $created_at, string $link)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->target_amount = $target_amount;
        $this->created_at = $created_at;
        $this->link = $link;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTargetAmount(): int
    {
        return $this->target_amount;
    }

    public function setTargetAmount(int $target_amount): static
    {
        $this->target_amount = $target_amount;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): static
    {
        $this->link = $link;

        return $this;
    }
}
