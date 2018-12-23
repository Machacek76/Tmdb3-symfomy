<?php

namespace App\Controller\Api;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Api\BaseController;



class PeopleController extends BaseController
{
    /**
     * @Route("/api/people", name="people")
     */
    public function index()
    {
        return $this->render('people/index.html.twig', [
            'controller_name' => 'PeopleController',
        ]);
    }




    /**
     * @Route("/api/people/load/{id}", name="load-people")
     */
    public function load(int $id = 1)
    {

        $id = $id > 0 ? $id : 1;


        return new JsonResponse(['id'=>$id]);
    }


    
    /**
     * @Route("/api/people/load-sequens/{ln}", name="load-sequens-people")
     */
    public function loadSequens(int $ln = 1)
    {   

        if($ln > 100){
            $ln = 100;
        }else if($ln < 1){
            $ln = 1;
        }

        return new JsonResponse(['ln'=>$ln]);
    }




}
