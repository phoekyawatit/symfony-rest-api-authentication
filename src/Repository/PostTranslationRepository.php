<?php

namespace App\Repository;

use App\Entity\PostTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostTranslation>
 *
 * @method PostTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostTranslation[]    findAll()
 * @method PostTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostTranslation::class);
    }

//    /**
//     * @return PostTranslation[] Returns an array of PostTranslation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PostTranslation
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
