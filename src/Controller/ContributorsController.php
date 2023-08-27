<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\ContributorUpdateRequest;
use App\Model\IdResponse;
use App\Service\ContributorService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
class ContributorsController extends AbstractController
{
    public function __construct(private readonly ContributorService $contributorService)
    {
    }
    #[Route(path:'/api/v1/contributor/get/{id}',methods: ['GET'])]
    public function get(int $id): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json($this->contributorService->getContributorById($id));
    }
    #[Route(path:'/api/v1/contributor/new',methods: ['POST'])]
    #[OA\Response(response: 200, description: 'Create a new contributor', attachables: [new Model(type: IdResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: ContributorUpdateRequest::class)])]
    public function new(#[RequestBody] ContributorUpdateRequest $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json($this->contributorService->newContributor($request));
    }
    #[Route('/api/v1/contributor/edit/{id}',methods: ['POST'])]
    #[OA\Response(response: 200, description: 'Edit a contributor', attachables: [new Model(type: IdResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: ContributorUpdateRequest::class)])]
    public function edit(int $id,#[RequestBody] ContributorUpdateRequest $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json($this->contributorService->updateContributor($id,$request));
    }
    #[Route('/api/v1/contributor/delete/{id}',methods: ['GET'])]
    public function delete(int $id): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $this->contributorService->deleteContributor($id);
        return $this->json(null);
    }
}
