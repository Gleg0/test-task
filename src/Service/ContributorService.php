<?php

namespace App\Service;

use App\Entity\Contributor;
use App\Exception\CollectionNotFoundException;
use App\Exception\ContributorNotFoundException;
use App\Model\ContributorUpdateRequest;
use App\Model\IdResponse;
use App\Repository\ContributorRepository;

class ContributorService
{
    public function __construct(private readonly ContributorRepository $contributorRepository)
    {
    }
    public function newContributor(ContributorUpdateRequest $request): IdResponse
    {
        $contributor = new Contributor();
        $this->upsertContributor($contributor,$request);
        return new IdResponse($contributor->getId());
    }
    public function deleteContributor(int $id): void
    {
        $contributor = $this->contributorRepository->find($id);
        if(null === $contributor){
            throw new ContributorNotFoundException();
        }
        $this->contributorRepository->removeAndCommit($contributor);
    }
    public function updateContributor(int $id, ContributorUpdateRequest $updateRequest): void
    {
        $this->upsertContributor($this->contributorRepository->getById($id), $updateRequest);
    }
    private function upsertContributor(Contributor $contributor, ContributorUpdateRequest $updateRequest): void
    {
        $contributor
            ->setCollection($updateRequest->getCollection())
            ->setUserName($updateRequest->getUserName())
            ->setAmount($updateRequest->getAmount());
        $this->contributorRepository->saveAndCommit($contributor);
    }

    public function getContributorById(int $id): Contributor{
        $contributor = $this->contributorRepository->find($id);

        if(null === $contributor){
            throw new CollectionNotFoundException();
        }
        return $contributor;
    }
}
