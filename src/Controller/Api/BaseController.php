<?php
// src/Controller/DefaultController.php
namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;


class BaseController extends AbstractController{



    public $cache;

    const  CACHETIME = 600;

    protected $response;


    /**
     * $nocache
     *
     * @var null
     */
    protected $nocache = NULL;


    public function __construct()
    {   
        $this->cache = new FilesystemCache();

        $this->request = Request::createFromGlobals();

        $this->nocache = $this->request->query->get('nocache');
    }



    public function getCache (string $key )
    {
        if(!$this->cache->has($key)){
            return NULL;
        }else{
            $res = $this->cache->get($key);
            $ts = time();
            
            if(!isset($res['time'])) {
                return NULL;
            }else if($res['time'] > $ts){
                return $res['data'];
            }else{
                return NULL;
            }
        }
    }

    public function setCache( string $key, array $data, int $cacheTime = self::CACHETIME )
    {
        $ins = [
                'time'  => time() + $cacheTime,
                'data'  => $data,
                ];

        $this->cache->set($key, $ins );
    }






}