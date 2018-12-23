<?php

namespace App\Controller\Api;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Simple\FilesystemCache;

use App\Controller\Api\BaseController;
use App\Repository\Tmdb\MyTmdb;
use App\Model\PeopleModel;



class PeopleController extends BaseController
{



    /**
     * $tmdb
     *
     * @var App\Repository\Tmdb\MyTmdb;
     */
    protected $tmdb;

    /**
     * $people
     *
     * @var array
     */
    protected $people;




    /**
     * __construct
     *
     * @param App\Repository\Tmdb\MyTmdb $tmdb
     * @return void
     */
    public function __construct(MyTmdb $tmdb)
    {
        parent::__construct();
        $this->tmdb = $tmdb;
    }


    /**
     * @Route("/api/people", name="people")
     */
    public function index(MyTmdb $tmdb)
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

        if($id === 0){
            return new JsonResponse(array('error'=>'Wrong people id'));
        }
        
        $peopleModel = new PeopleModel($this->getDoctrine());
        $this->people = $this->tmdb->getPerson($id, 'cs');

        if(array_key_exists('status_code', $this->people)){
            return new JsonResponse($this->people);
        }

        if($this->people['biography'] === ''){
            $this->people = $this->tmdb->getPerson($id, 'en');
            $peopleModel->makePeople($this->people, 'en');
        }else{
            $peopleModel->makePeople($this->people, 'cs');
        }


        return new JsonResponse(['id'=>$id, 'person'=>$this->people]);
    }

    
    /**
     * @Route("/api/people/load-sequens/{ln}", name="load-sequens-people")
     */
    public function loadSequens(int $ln = 1)
    {   


        if( !$this->cache->has('api.people.loadSequens.last')){
            $last = 1;
        }else{
            $last = $this->cache->get('api.people.loadSequens.last');
        }

        if($ln === 0){
            return new JsonResponse($last);
        }

        $ln = $ln > 100 ? $last + 20 : $last + $ln;
        $out = [];

        for ($i = $last; $i < $ln; $i ++ ){
            $this->cache->set('api.people.loadSequens.last', $i);
            $url = "https://tmdb3.jsvyvoj.cz/api/people/load/" . $i;
            $data = file_get_contents($url);
            $out[] = [ 'url' => $url, 'data' => json_decode($data) ];    
        }
        
        $this->cache->set('api.people.loadSequens.last', $i);

        return new JsonResponse($out);
    }




}
