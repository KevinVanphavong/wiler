<?php

namespace App\Repository;

use App\Entity\Entertainement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entertainement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entertainement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entertainement[]    findAll()
 * @method Entertainement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntertainementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entertainement::class);
    }

    public function findAllExceptOther()
    {
        return $this->createQueryBuilder('w')
            ->Where('w.name NOT LIKE :val')
            ->setParameter('val', '%' . 'Autre' . '%')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Entertainement[] Returns an array of Entertainement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entertainement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
