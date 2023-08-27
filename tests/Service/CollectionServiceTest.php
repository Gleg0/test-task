<?php

namespace App\Tests\Service;

use App\Entity\Collection;
use App\Model\CollectionsListItem;
use App\Model\CollectionsListResponse;
use App\Repository\CollectionRepository;
use App\Service\CollectionService;
use Doctrine\Common\Collections\Criteria;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class CollectionServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetCollections(): void
    {
        $repository = $this->createMock(CollectionRepository::class);
        $repository->expects($this->once())
            ->method('findBy')
            ->with([], ['title' => Criteria::ASC])
            ->willReturn([(new Collection())
                ->setId(1)
                ->setTitle('test-1')
                ->setDescription('test-name-1')
                ->setTargetAmount(100)
                ->setCreatedAt(new \DateTimeImmutable('2023-01-01 10:00:00'))
                ->setLink('test-link-1')]);
        $service = new CollectionService($repository);
        $expected = new CollectionsListResponse(
            [new CollectionsListItem(1, 'test-1', 'test-name-1', 100, new \DateTimeImmutable('2023-01-01 10:00:00'), 'test-link-1')]);
        $this->assertEquals($expected, $service->getCollections());
    }
}
