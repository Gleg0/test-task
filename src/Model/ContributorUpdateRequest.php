<?php
namespace App\Model;
use Symfony\Component\Validator\Constraints\NotBlank;
class ContributorUpdateRequest
{
    #[NotBlank]
    private int $collection;
    #[NotBlank]
    private string $user_name;
    #[NotBlank]
    private int $amount;
    public function getCollection(): int
    {
        return $this->collection;
    }

    public function setCollection(int $collection): void
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
