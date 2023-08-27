<?php

namespace App\Service;

use App\Entity\Collection;
use App\Entity\Contributor;
use App\Exception\CollectionNotFoundException;
use App\Model\CollectionsListItem;
use App\Model\CollectionsListResponse;
use App\Model\CollectionUpdateRequest;
use App\Repository\CollectionRepository;
use App\Repository\ContributorRepository;
use Doctrine\Common\Collections\Criteria;
use App\Model\IdResponse;
use PhpParser\Node\Expr\Array_;

class CollectionService
{
    public function __construct(private readonly CollectionRepository $collectionRepository,private readonly ContributorRepository $contributorRepository)
    {
    }

    public function getCollections(): CollectionsListResponse
    {

        $collections = $this->collectionRepository->findBy([], ['title' => Criteria::ASC]);
        $items = array_map(
            fn (Collection $collection) => new CollectionsListItem(
                $collection->getId(),
                $collection->getTitle(),
                $collection->getDescription(),
                $collection->getTargetAmount(),
                $collection->getCreatedAt(),
                $collection->getLink()
            ),
            $collections
        );
        return new CollectionsListResponse($items);
    }
    public function getCollectionById(int $id):Collection{
        $collection = $this->collectionRepository->find($id);

        if(null === $collection){
            throw new CollectionNotFoundException();
        }
        return $collection;
    }

    /**
     * @throws \Exception
     */
    public function newCollection(CollectionUpdateRequest $request): IdResponse
    {
        $collection = new Collection();
        $this->upsertCollection($collection,$request);
        return new IdResponse($collection->getId());

    }

    public function deleteCollection(int $id): void
    {
        $collection = $this->collectionRepository->find($id);

        if(null === $collection){
            throw new CollectionNotFoundException();
        }
        $this->collectionRepository->removeAndCommit($collection);
    }

    /**
     * @throws \Exception
     */
    public function updateCollection(int $id, CollectionUpdateRequest $updateRequest): void
    {
        $this->upsertCollection($this->collectionRepository->getById($id), $updateRequest);
    }

    /**
     * @throws \Exception
     */
    private function upsertCollection(Collection $collection, CollectionUpdateRequest $updateRequest): void
    {
        $collection
            ->setTitle($updateRequest->getTitle())
            ->setDescription($updateRequest->getDescription())
            ->setTargetAmount($updateRequest->getTargetAmount())
            ->setCreatedAt(new \DateTimeImmutable())
            ->setLink($updateRequest->getLink());
        $this->collectionRepository->saveAndCommit($collection);
    }

    public function getNotCompleted(): CollectionsListResponse
    {
        $result = new \ArrayObject();
        $i = 0;
        $collections = $this->collectionRepository->findAll();
        foreach ($collections as  $collection){
            $contributors = $this->contributorRepository->findBy(['collection'=>$collection->getId()]);
            $sum = 0;
            foreach ($contributors as $contributor){;
                $sum += $contributor->getAmount();
            }
            if($sum < $collection->getTargetAmount()){
                $result->append($collection);
            }
            $items = array_map(
                fn (Collection $collection) => new CollectionsListItem(
                    $collection->getId(),
                    $collection->getTitle(),
                    $collection->getDescription(),
                    $collection->getTargetAmount(),
                    $collection->getCreatedAt(),
                    $collection->getLink()
                ),
                $result->getArrayCopy()
            );

        }
        return new CollectionsListResponse($items);
    }
}
