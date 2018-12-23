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




    public function __construct()
    {   
        $this->cache = new FilesystemCache();

        $this->request = Request::createFromGlobals();
    }



    public function getCache (string $key )
    {
        if(!$this->cache->has($key)){
            return NULL;
        }else{
            $res = $this->cache->get($key);
            $ts = time();
            if($res['time'] > $ts){
//                var_dump($res['data']);
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