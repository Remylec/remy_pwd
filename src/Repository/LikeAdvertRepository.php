<?php

namespace App\Repository;

use App\Entity\LikeAdvert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LikeAdvert|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeAdvert|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeAdvert[]    findAll()
 * @method LikeAdvert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeAdvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikeAdvert::class);
    }

    // /**
    //  * @return LikeAdvert[] Returns an array of LikeAdvert objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LikeAdvert
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
