<?php

namespace App\Repository;

use App\Entity\Collection;
use App\Exception\CollectionNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Collection>
 *
 * @method Collection|null find($id, $lockMode = null, $lockVersion = null)
 * @method Collection|null findOneBy(array $criteria, array $orderBy = null)
 * @method Collection[]    findAll()
 * @method Collection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionRepository extends ServiceEntityRepository
{
    use RepositoryModifyTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Collection::class);
    }
    public function getById(int $id): Collection
    {
        $collection = $this->find($id);
        if (null === $collection) {
            throw new CollectionNotFoundException();
        }

        return $collection;
    }
}
