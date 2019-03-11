<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Genres;
use App\Entity\ProductionCompanies;

use App\Model\MovieModel;
use App\Entity\Movie;
use Doctrine\ORM\EntityManager;

class IndexController extends BaseController
{



    
    /**
     * @Route("/api/index", name="menindexu")
     */
    public function getIndex()
    {
        
        $cacheKey = 'api.index';
        $index = $this->getCache($cacheKey);

        if( !$index || $this->nocache !== NULL){
            $index = $this->renderIndex();
            $this->setCache($cacheKey, $index);
        }

        return new JsonResponse($index);
    }





    /**
     * renderIndex
     *
     * @return array
     */
    public function renderIndex(): array
    {
        $items = [
            "reder" => date('Y-m-d H:i:s'),
            "hero"  => $this->getHero(),
            "films" => $this->getFilms(),
        ];

        return array('items' => $items);
    }


    

    /**
     * getHero
     *
     * @return array
     */
    public function getHero():array
    {
        $hero = [
            'src'   => "https://via.placeholder.com/1080x400?text=hero%20captain%20marvel",
            'link'  => "/filmy",
            'title' => "filmy"
        ];

        return $hero;
    }

    public function getFilms():array
    {
        
        $movieModel  = new MovieModel($this->getDoctrine());
        $lastid = $movieModel->gatLastId();

        $out = [];

        for($i = 0; $i < 10; $i++){
            $rnd = rand ( 1 , $lastid );

            $movie = $movieModel->getMovie(rand (1 , $lastid ));
            
            while($movie['adult'] === True){
                $movie = $movieModel->getMovie(rand (1 , $lastid ));
            }

            $out[] = (array)$movie;
        }



        return $out;
    }



}
