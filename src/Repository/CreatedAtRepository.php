<?php

namespace App\Repository;

use App\Entity\CreatedAT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CreatedAT|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreatedAT|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreatedAT[]    findAll()
 * @method CreatedAT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreatedATRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CreatedAT::class);
    }

    // /**
    //  * @return CreatedAT[] Returns an array of CreatedAT objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CreatedAT
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
