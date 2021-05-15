<?php

namespace App\Repository;

use App\Entity\EntertainementImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EntertainementImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntertainementImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntertainementImage[]    findAll()
 * @method EntertainementImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntertainementImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntertainementImage::class);
    }

    // /**
    //  * @return EntertainementImage[] Returns an array of EntertainementImage objects
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
    public function findOneBySomeField($value): ?EntertainementImage
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
