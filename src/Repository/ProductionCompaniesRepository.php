<?php

namespace App\Repository;

use App\Entity\ProductionCompanies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductionCompanies|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionCompanies|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionCompanies[]    findAll()
 * @method ProductionCompanies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionCompaniesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductionCompanies::class);
    }

    // /**
    //  * @return ProductionCompanies[] Returns an array of ProductionCompanies objects
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
    public function findOneBySomeField($value): ?ProductionCompanies
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
