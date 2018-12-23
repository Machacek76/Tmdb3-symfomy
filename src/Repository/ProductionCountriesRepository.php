<?php

namespace App\Repository;

use App\Entity\ProductionCountries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductionCountries|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionCountries|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionCountries[]    findAll()
 * @method ProductionCountries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionCountriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductionCountries::class);
    }

    // /**
    //  * @return ProductionCountries[] Returns an array of ProductionCountries objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductionCountries
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
