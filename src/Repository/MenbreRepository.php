<?php

namespace App\Repository;

use App\Entity\Menbre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Menbre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Menbre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Menbre[]    findAll()
 * @method Menbre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenbreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Menbre::class);
    }

    // /**
    //  * @return Menbre[] Returns an array of Menbre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Menbre
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function FindAllPaginate()
    {
        return $this->createQueryBuilder('m')
            ->getQuery()
        ;
    }
}
