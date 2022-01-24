<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Adverts;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adverts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adverts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adverts[]    findAll()
 * @method Adverts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adverts::class);
        $this->em = $this->getEntityManager();
    }


    public function findSearch(SearchData $search): array
    {


        $query = $this
            ->createQueryBuilder('a')
            ->select('a');

        $secondquery = $this->em->createQueryBuilder();

        $brands = [];
        foreach ($search->brands as $brand) {
            array_push($brands, $brand->getTitle());
        }

        $secondquery
            ->select('p')
            ->from(Product::class, 'p')
            ->join('p.brand', 'b')
            ->where('b.title IN (:brands)')
            ->setParameter('brands', $brands);

        //dd($search->brands);
        //dd($secondquery->getQuery()->getResult());

        if (!empty($search->q)) {
            $query = $query
                ->andWhere('a.title LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->brands)) {

            $query = $query
                ->andWhere('a.product IN (:products)')
                ->setParameter('products', $secondquery->getQuery()->getResult());

        }

        return $query->getQuery()->getResult();

    }

    // /**
    //  * @return Adverts[] Returns an array of Adverts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adverts
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
