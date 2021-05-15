<?php

namespace App\Repository;

use App\Entity\Wilfer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wilfer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wilfer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wilfer[]    findAll()
 * @method Wilfer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WilferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wilfer::class);
    }

    public function findWithSpecialRequest($value)
    {
        return $this->createQueryBuilder('w')
            ->orWhere('w.firstname LIKE :val')
            ->orWhere('w.lastname LIKE :val')
            ->orWhere('w.description LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('w.firstname', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Wilfer[] Returns an array of Wilfer objects
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
    public function findOneBySomeField($value): ?Wilfer
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
