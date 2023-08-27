<?php
namespace App\Model;
use Symfony\Component\Validator\Constraints\NotBlank;
class CollectionUpdateRequest
{
    #[NotBlank]
    private string $title;
    #[NotBlank]
    private string $description;
    #[NotBlank]
    private int $target_amount;
    #[NotBlank]
    private string $link;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getTargetAmount(): int
    {
        return $this->target_amount;
    }

    public function setTargetAmount(int $target_amount): void
    {
        $this->target_amount = $target_amount;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

}
