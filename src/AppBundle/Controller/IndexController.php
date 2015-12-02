<?php
namespace AppBundle\Controller;

use AppBundle\Service\ApiService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="app.index_controller")
 */
class IndexController{
    public function __construct(ApiService  $service) {
        $this->service = $service;
    }

    /**
     * @Route("/index")
     */
    public function indexAction(){
        $this->service->getFu();
        return new Response('fu');
    }

}