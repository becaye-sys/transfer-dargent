<?php

namespace App\Repository;

use App\Entity\DataPart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DataPart|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataPart|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataPart[]    findAll()
 * @method DataPart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataPartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataPart::class);
    }

    // /**
    //  * @return DataPart[] Returns an array of DataPart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DataPart
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
