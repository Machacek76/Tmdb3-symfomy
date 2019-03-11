<?php


namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;




class MenuController extends BaseController{

    /**
     * @Route("/api/menu", name="menu")
     */
    public function getMenu()
    {
        
        if( !$this->cache->has('api.menu') || $this->nocache !== NULL){
            $menu = $this->renderMenu();
            $this->cache->set('api.menu', $menu);
        }else{
            $menu = $this->cache->get('api.menu');
        }

        return new JsonResponse($menu);

    }




    private function renderMenu()
    {   

        $menu = [
            [
                'link'      => '/',
                'name'      => 'Home',
                'iconClass' => 'fa-home',
                'reouter'   => 'index',
                'id'        => 0
            ],
            [
                'link'      => '/lide',
                'name'      => 'Lidé',
                'iconClass' => 'fa-user',
                'router'    => 'people',
                'id'        => 1
            ],
            [
                'link'      => '/filmy',
                'name'      => 'Filmy',
                'iconClass' => 'fa-film',
                'router'    => 'people',
                'id'        => 2
            ],
            [
                'link'      => '/serialy',
                'name'      => 'Seriály',
                'iconClass' => 'fa-desktop',
                'router'    => 'serials',
                'id'        => 3
            ],
        ];


        return  array( 'items' =>  $menu);
    }

}




