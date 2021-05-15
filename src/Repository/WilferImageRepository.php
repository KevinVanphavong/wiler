<?php

namespace App\Repository;

use App\Entity\WilferImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WilferImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method WilferImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method WilferImage[]    findAll()
 * @method WilferImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WilferImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WilferImage::class);
    }

    // /**
    //  * @return WilferImage[] Returns an array of WilferImage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WilferImage
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
