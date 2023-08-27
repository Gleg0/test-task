<?php

namespace App\Repository;

use App\Entity\Contributor;
use App\Exception\CollectionNotFoundException;
use App\Exception\ContributorNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contributor>
 *
 * @method Contributor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contributor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contributor[]    findAll()
 * @method Contributor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContributorRepository extends ServiceEntityRepository
{
    use RepositoryModifyTrait;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contributor::class);
    }
    public function getById(int $id): Contributor
    {
        $contribution = $this->find($id);
        if (null === $contribution) {
            throw new ContributorNotFoundException();
        }

        return $contribution;
    }
}
