<?php

namespace App\Repository;

use App\Entity\Movie;
use App\Repository\GenresRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Cocur\Slugify\Slugify;


/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movie::class);
    }





    public function getMovieByNormalize(string $alpha, int $page = 1)
    {

        $limit  = 50 + 1;
        $offset = $page * 50 - 50;

        $res = $this->createQueryBuilder('g')
             ->addSelect('g.title, g.tagline, g.uid, g.normalizeTitle, g.original_language, g.status, g.original_title, g.genres_id')
             ->andWhere('g.normalizeTitle LIKE  :like')
             ->setparameter('like', $alpha.'%')
             ->orderBy('g.normalizeTitle')             
             ->setFirstResult( $offset )
             ->setMaxResults( $limit )
             ->getQuery()
             ->getResult();

        $out = [];

        $slugify = new Slugify();

        $genres = $this->getEntityManager()->getRepository(\App\Entity\Genres::class);
        
        
        foreach ($res as $val){
            $gen = [];
            foreach($val['genres_id'] as $_val){
                $gen[] = $genres->getGenre($_val);
            }
            $out[] = [  
                        'title'              => $val['title'], 
                        'normalizeTitle'     => $val['normalizeTitle'], 
                        'uid'                => $val['uid'],
                        'tagline'            => $val['tagline'],
                        'status'             => $val['status'],
                        'originalTitle'      => $val['original_title'],
                        'genres'             => $gen,
                    ];
        }

        return $out;
    }





    // /**
    //  * @return Genres[] Returns an array of Genres objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Genres
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }*/


}
