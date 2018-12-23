<?php

namespace App\Repository;

use App\Entity\MovieVideos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MovieVideos|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieVideos|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieVideos[]    findAll()
 * @method MovieVideos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieVideosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MovieVideos::class);
    }

    // /**
    //  * @return MovieVideos[] Returns an array of MovieVideos objects
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
    public function findOneBySomeField($value): ?MovieVideos
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
