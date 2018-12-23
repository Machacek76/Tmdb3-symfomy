<?php

namespace App\Repository;

use App\Entity\MovieCredit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MovieCredit|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieCredit|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieCredit[]    findAll()
 * @method MovieCredit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieCreditRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MovieCredit::class);
    }

    // /**
    //  * @return MovieCredit[] Returns an array of MovieCredit objects
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
    public function findOneBySomeField($value): ?MovieCredit
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
