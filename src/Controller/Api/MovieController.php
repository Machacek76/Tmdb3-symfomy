<?php
// src/Controller/DefaultController.php
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


class MovieController extends BaseController{
    

    
    /**
     * $tmdb
     *
     * @var App/Repository/Tmdb/MyTmdb
     */
    public $tmdb;

    /**
     * $movie
     *
     * @var array
     */
    public $movie;

    /**
     * $movieVideos
     *
     * @var App/Model/MovieVideosModel
     */
    public $movieVideos;


    /**
     * $movieCredits
     *
     * @var App/Model/MovieCreditsModel
     */
    public $movieCredits;




    /**
     * __construct
     *
     * @param MyTmdb $tmdb
     * @return void
     */
    public function __construct(MyTmdb $tmdb)
    {
        parent::__construct();
        $this->tmdb = $tmdb;
    }
    
    
    
    
    
    /**
     * index
     *
     * @return void
     */
    public function index(){
        return new Response('{}');
    }




    /**
     * load
     *
     * @param int $id
     * @return void
     */
    public function load(int $id)
    {

        if($id === 0){
            return new JsonResponse(array('error'=>'Wrong movie id'));
        }
        
        $this->movie        = $this->tmdb->getMovie($id);
        $movieModel         = new MovieModel($this->getDoctrine());
        $movieVideosModel   = new MovieVideosModel($this->getDoctrine());
        $movieCreditsModel  = new MovieCreditsModel($this->getDoctrine());
        

        if(array_key_exists('status_code', $this->movie)){
            return new JsonResponse($this->movie);
        }


        if($this->movie['overview'] === ''){
            $this->movie = $this->tmdb->getMovie($id, 'en');
            $ret = $movieModel->makeMovie($this->movie, 'en');
        }else{
            $ret = $movieModel->makeMovie($this->movie, 'cs');
        }

        $this->movieVideos = $this->tmdb->getMovieVideos($id, 'cs');
        $movieVideosModel->makeMovieVideos($this->movieVideos);
        $this->movieVideos = $this->tmdb->getMovieVideos($id,'en');
        $movieVideosModel->makeMovieVideos($this->movieVideos);

        $this->movieCredits = $this->tmdb->getMovieCast($id);
        $movieCreditsModel->makeMovieCredits($this->movieCredits);


        return new JsonResponse([$this->movie]);
    }




    /**
     * loadSequens
     *
     * @param int $ln
     * @return void
     */
    public function loadSequens (int $ln)
    {
        
        if( !$this->cache->has('api.movie.loadSequens.last')){
            $last = 1;
        }else{
            $last = $this->cache->get('api.movie.loadSequens.last');
        }

        if($ln === 0){
            return new JsonResponse($last);
        }

        $ln = $ln > 100 ? $last + 20 : $last + $ln;
        $out = [];

        for ($i = $last; $i < $ln; $i ++ ){
            $this->cache->set('api.movie.loadSequens.last', $i);
            $url = "https://tmdb3.jsvyvoj.cz/api/movie/load/" . $i;
            $data = file_get_contents($url);
            $out[] = [ 'url' => $url, 'data' => json_decode($data) ];    
        }
        
        $this->cache->set('api.movie.loadSequens.last', $i);

        return new JsonResponse($out);
    }



    /**
     * @Route("/api/movie/get/{type}")
     */
    public function getMovies (string $type = 'a-z'){


        $page       = $this->request->query->get('p');
        $page       = (int)$page;
        $page       = $page > 0 ? $page : 1;
        $out        =  [];
        $movieModel = new MovieModel($this->getDoctrine());
        $cacheKey   = 'api.movieController.getMovies.'.$type.'page-'.$page;
        $movie      = $this->getDoctrine()->getRepository(Movie::class);
        
        $out        = $this->getCache($cacheKey);

        if(!$out){
            switch ($type){
                case 'a-z':
                    $out = $movieModel->getAlpahCountNumList();
                    $this->setCache($cacheKey, $out);
                break;
                default:
                    $data = $movie->getMovieByNormalize($type, $page);

                    $out = $this->moviePaginator($type, $data, $page);

                    $this->setCache($cacheKey, $out);
            }
        }



        return new JsonResponse($out);
    }

    
    /**
     * moviePaginator
     * adding link next and prew, remeve key on 50 index 
     * output array have max lenght 50
     * 
     * @param string $type
     * @param array $data 
     * @param int $page
     * @return array
     */
    public function moviePaginator(string $type, array $data, int $page):array{   

        $links  = ['next'=>'', 'prew'=>''];
        $cnt    = count($data);

        if( $cnt === 0 ){
            return [ 'error' => [ 'msg' => "Page nr. $page notfound!" ]  ];
        }else if( $cnt > 50 ){
            $links['next'] = $_SERVER['REQUEST_URI'] . "/api/movie/get/" . $type . "?p=" . ( $page + 1 );
        }

        if($page > 1) {
            $links['prew'] = $_SERVER['REQUEST_URI'] . "/api/movie/get/" . $type . "?p=" . ( $page - 1 ); 
        }

        array_pop($data);

        return ['links'=>$links, 'data'=>$data] ;
    }





}




