<?php
namespace AppBundle\Controller;

use AppBundle\Service\ApiService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\MetaSearchType;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller {
    protected $apiService;
    public function __construct()
    {

    }

    /**
     * @Route("/game/roll",name="game_roll")
     */
    public function rollAction(Request $request)
    {

    }

    /**
     * @Route("game/find",name="game_find")
     */
    public function findAction(Request $request){
        $service = $this->apiService = $this->get('api_service');

        $form = $this->createForm(new MetaSearchType($service));

        $form->handleRequest($request);

        $this->addFlash('notice',$request->getMethod());

        return $this->render('meta/game_find.html.twig', array(
                'form' => $form->createView()
            )
        );
    }
    /**
     * @Route("game/list",name="game_list")
     */
    public function listAction(){

    }

}