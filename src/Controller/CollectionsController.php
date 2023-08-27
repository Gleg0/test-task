<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Entity\Collection;
use App\Model\CollectionUpdateRequest;
use App\Model\IdResponse;
use App\Repository\CollectionRepository;
use App\Service\CollectionService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
class CollectionsController extends AbstractController
{
    public function __construct(private readonly CollectionService $collectionService)
    {
    }

    #[Route(path:'/api/v1/collection/collections',methods: ['GET'])]
    public function collections(): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json(data: $this->collectionService->getCollections());
    }

    /**
     * @throws \Exception
     */
    #[Route(path:'/api/v1/collection/new',methods: ['POST'])]
    #[OA\Response(response: 200, description: 'Create a new collection', attachables: [new Model(type: IdResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: CollectionUpdateRequest::class)])]
    public function new(#[RequestBody] CollectionUpdateRequest $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json($this->collectionService->newCollection($request));
    }
    #[Route('/api/v1/collection/edit/{id}',methods: ['POST'])]
    #[OA\Response(response: 200, description: 'Edit a collection', attachables: [new Model(type: IdResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: CollectionUpdateRequest::class)])]
    public function edit(int $id,#[RequestBody] CollectionUpdateRequest $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json($this->collectionService->updateCollection($id,$request));
    }
    #[Route('/api/v1/collection/delete/{id}',methods: ['GET'])]
    public function delete(int $id): \Symfony\Component\HttpFoundation\JsonResponse
    {
       $this->collectionService->deleteCollection($id);
       return $this->json(null);
    }
    #[Route(path:'/api/v1/collection/get/{id}',methods: ['GET'])]
    public function get(int $id): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json($this->collectionService->getCollectionById($id));
    }
    #[Route(path:'/api/v1/collection/getNotCompleted',methods: ['GET'])]
    public function getNotCompleted(): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json($this->collectionService->getNotCompleted());
    }

}
