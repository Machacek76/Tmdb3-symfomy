<?php


namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\Tmdb\MyTmdb;
use App\Entity\Genres;
use App\Entity\ProductionCompanies;

use App\Model\MovieModel;
use App\Model\MovieVideosModel;
use App\Model\MovieCreditsModel;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManager;


class DefaultController extends BaseController{

    /**
     * @Route("/api/menu", name="menu")
     */
    public function getMenu()
    {


    }


}




