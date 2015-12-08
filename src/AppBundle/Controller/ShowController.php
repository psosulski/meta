<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Entry;
use AppBundle\Service\ApiService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Movie;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(service="app.index_controller")
 */
class IndexController extends Controller
{
    //example of use injecting form facotry when using controller as service
//    private $formFactory;
//    public function setFormFactory(FormFactory $formFactory){
//        $this->formFactory = $formFactory;
//    }


    public function __construct(ApiService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/index")
     */
    public function indexAction(Request $request)
    {
        //type => params
        $availableParams = array(
            //find/game
            'game' => array(
                'platform' => '%s',
                'title' => '%s'
            ),
            //game-list
            'game-list' => array(
                'list_type' => '%s', //coming-soon, new-releases, all
                'platform' => '%s',
                'order_by' => '%s', //date,metascore,name,userscore, def date
                'page' => '%s'      //number, totalpages,next page
            ),
            //search/game
            'search-games' => array(
                'max_pages' => '%d',
                'platform' => '%s',
                'title' => '%s',
                'year_from' => '%s',
                'year_to' => '%s'
            ),
            //find/movie
            'movie' => array(
                'title' => '%s',
            ),
            //movie-list/coming-soon
            'movie-coming-soon' => null,
            //movie-list/new-releases
            'movie-new-releases' => array(
                'order_by' => '%s', //date, metascore, name, userscore
            ),
            //search/movie
            'search-movie' => array(
                'max-pages' => '%d',
                'title' => '%s',
                'year_from' => '%s',
                'year_to' => '%s',
            ),
            //find/album
            'album' => array(
                'artist' => '%s',
                'title' => '%s',
            ),
            //album-list/coming-soon
            'album-comings-soon' => null,
            //album-list/new-releases
            'album-new-releases' => array(
                'order_by' => '%s'
            ),
            //search/album
            'search-album' => array(
                'max_pages' => '%s',
                'title' => '%s',
                'year_from' => '%s',
                'year_to' => '%s',
            ),
            //find/tv
            'tv' => array(
                'title' => '%s',
            ),
            //search/tv
            'search-tv' => array(
                'max_pages' => '%s',
                'title' => '%s',
                'year_from' => '%s',
                'year_to' => '%s',
            ),
            //reviews
            'reviews' => array(
                'order_by' => '%s', // critics-score, most-active, publication, most-clicked.
                'url' => '%s', //http://www.metacritic.com/game/pc/portal-2
            ),
            //details
            'details' => array(
                'url' => '%s' //http://www.metacritic.com/game/playstation-3/the-elder-scrolls-v-skyrim
            )



        );

//        $data = $this->service->getData($type, $params);


        $entry = new Entry();
        $entry->setName('entry');

        //when we got a separate class
//        $form = $this->createForm(TaskType::class, $task);
//        $form->get('dueDate')->getData();
//        $form->get('dueDate')->setData(new \DateTime());
//        $task = $form->getData();


//        $form = $this->createFormBuilder($users, array(
//        'validation_groups' => array('registration'))
        //guessing will happen when second add() param is omitted
        $form = $this->createFormBuilder()
//            ->setAction($this->generateUrl('/index/index'))
            ->setMethod("GET")
            ->add('name','text')
            ->add('save','submit',array('label'=> 'Save','validation_groups'=>'meta_search',
                'attr' => array(
                    'maxlength' => 4
                )
            ))
            ->getForm();

        $form->handleRequest($request);
        //isSubmitted()
        if($form->isValid()){
            $isClicked = $form->get('save')->isClicked();
//            return $this->redirectToRoute('task_success');
        }

        return $this->render('default/new.html.twig',array(
            //create view after handle request due to events system
            'form' => $form->createView()
        ));







        return new Response('fu');
    }

    public function movieTestAction()
    {
        $product = new Movie();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');
        //This article shows working with Doctrine from within a controller by using the getDoctrine() method of the controller. This method is a shortcut to get the doctrine service. You can work with Doctrine anywhere else by injecting that service in the service. See Service Container for more on creating your own services.
        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();

        return new Response('Created product id ' . $product->getId());

        //fetch
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        //particular
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Product');

        // query by the primary key (usually "id")
        $product = $repository->find($id);

        // dynamic method names to find based on a column value
        $product = $repository->findOneById($id);
        $product = $repository->findOneByName('foo');

        // find *all* products
        $products = $repository->findAll();

        // find a group of products based on an arbitrary column value
        $products = $repository->findByPrice(19.99);
        // query for one product matching by name and price
        $product = $repository->findOneBy(
            array('name' => 'foo', 'price' => 19.99)
        );

        // query for all products matching the name, ordered by price
        $products = $repository->findBy(
            array('name' => 'foo'),
            array('price' => 'ASC')
        );


        //updating

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('homepage');

        //delete

        $em->remove($product);
        $em->flush();
    }

    public function dqlAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
    FROM AppBundle:Product p
    WHERE p.price > :price
    ORDER BY p.price ASC'
        )->setParameter('price', '19.99');

        $products = $query->getResult();
// to get just one result:
// $product = $query->setMaxResults(1)->getOneOrNullResult();

        $product = $query->setMaxResults(1)->getOneOrNullResult();
    }

    public function queryBuilderAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Product');

// createQueryBuilder automatically selects FROM AppBundle:Product
// and aliases it to "p"
        $query = $repository->createQueryBuilder('p')
            ->where('p.price > :price')
            ->setParameter('price', '19.99')
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        $products = $query->getResult();
// to get just one result:
// $product = $query->setMaxResults(1)->getOneOrNullResult();
    }

    public function relatedEntitiesAction()
    {
        $category = new Entry();
        $category->setName('Main Products');

        $product = new Movie();
        $product->setName('Foo');
        $product->setPrice(19.99);
        $product->setDescription('Lorem ipsum dolor');
        // relate this product to the category
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Created product id: ' . $product->getId()
            . ' and category id: ' . $category->getId()
        );

        //fetchin related

        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($id);

        $categoryName = $product->getCategory()->getName();
    }

}