<?php
// src/Controller/DefaultController.php
namespace App\Controller\FrontEnd;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Simple\FilesystemCache;

class DefaultController extends BaseController
{

    /*
    public function index()
    {
        return new Response('
            <html>
                <body>
                    <h1>Hello Symfony 4 World</h1>
                </body>
            </html>
        ');
    }*/



    /**
     *  @Route("/{reactRouting}", name="index", defaults={"reactRouting": null})
     */
    public function index()
    {
        return $this->render('/frontend/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /* */
}




