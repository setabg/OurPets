<?php

namespace App\Repository;

use App\Entity\AddPets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AddPets>
 *
 * @method AddPets|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddPets|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddPets[]    findAll()
 * @method AddPets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddPetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddPets::class);
    }

    public function add(AddPets $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AddPets $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param string $petName
     * @return AddPets[]|null
     */
    public function findPetByName(string $petName): ?array

    {
        $queryBuilder = $this->createQueryBuilder('ap');
        if ($petName) {
            $queryBuilder
                ->andWhere('ap.name = :petName')
                ->setParameter('petName', $petName)
                ->orderBy('ap.createdAt', 'DESC');
        }
        return $queryBuilder
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

    }

    /**
     * @param string|null $petKind
     * @return AddPets[]|null
     */
    public function findPetByKind(string $petKind): ?array

    {
        $queryBuilder = $this->createQueryBuilder('ap');
        if ($petKind) {
            $queryBuilder
                ->andWhere('ap.petKind = :petKind')
                ->setParameter('petKind', $petKind)
                ->orderBy('ap.createdAt', 'DESC');
        }
        return $queryBuilder
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

    }

    /**
     * @param string $petName
     * @param string $petKind
     * @return AddPets[]|null
     */
    public function findPetByKindAndName(string $petName, string $petKind): ?array

    {
        $queryBuilder = $this->createQueryBuilder('ap');

        if ($petKind && $petName) {
            $queryBuilder
                ->andWhere('ap.petKind = :petKind')
                ->setParameter('petKind', $petKind)
                ->andWhere('ap.name = :petName')
                ->setParameter('petName', $petName)
                ->orderBy('ap.createdAt', 'DESC');
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();

    }

    /**
     * @param string|null $petKind
     * @return AddPets[]|null
     */
    public function findAllPets(): ?array

    {
        $queryBuilder = $this->createQueryBuilder('ap');
            $queryBuilder
                ->orderBy('ap.createdAt', 'DESC');
        return $queryBuilder
            ->getQuery()
            ->getResult();

    }
//
//    public function findOneBySomeField($value): ?AddPets
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
