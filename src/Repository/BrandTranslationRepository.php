<?php

namespace App\Repository;

use App\Entity\BrandTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BrandTranslation>
 *
 * @method BrandTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BrandTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BrandTranslation[]    findAll()
 * @method BrandTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandTranslation::class);
    }

//    /**
//     * @return BrandTranslation[] Returns an array of BrandTranslation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BrandTranslation
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
