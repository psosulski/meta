<?php
namespace MetaBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MetaController extends Controller{
    /**
     * @Route("/meta/{name}", name="fuuu")
     */
    public function indexAction($name, Request $request){



        return new Response($name);
    }
    public function redirectAction(){
        return $this->redirect($this->generateUrl('homepage'), 301);
    }
    public function requestAction(Request $request){
        $page = $request->query->get('page', 1);
        $session = $request->getSession();
        $session->set('foo', 'bar');
        $session->get('foo');
        $request->isXmlHttpRequest(); // is it an Ajax request?
        $request->getPreferredLanguage(array('en', 'fr'));
        $request->query->get('page'); // get a $_GET parameter
        $request->request->get('page'); // get a $_POST parameter
    }
    public function twigAction($name){
        return $this->render('hello/index.html.twig', array('name' => $name));
    }
    public function serviceAction(){
        $templating = $this->get('templating');
        $router = $this->get('router');
        $mailer = $this->get('mailer');

//        $ php app/console debug:container
    }
    public function flashAction(){
        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );
    }
    public function responseAction($name){
        // create a simple Response with a 200 status code (the default)
        $response = new Response('Hello '.$name, Response::HTTP_OK);
        // create a JSON-response with a 200 status code
        $response = new Response(json_encode(array('name' => $name)));
        $response->headers->set('Content-Type', 'application/json');
    }
    public function forwardAction($name){
        $response = $this->forward('AppBundle:Something:fancy', array(
            'name' => $name,
            'color' => 'green',
        ));
        // ... further modify the response or return it directly
        return $response;
    }
    public function uriAction(){
        $params = $this->get('router')->match('/blog/my-blog-post');
        // array(
        // 'slug' => 'my-blog-post',
        // '_controller' => 'AppBundle:Blog:show',
        // )
        $uri = $this->get('router')->generate('blog_show', array(
            'slug' => 'my-blog-post'
        ));
        $url = $this->generateUrl(
            'blog_show',
            array('slug' => 'my-blog-post')
        );
        $this->get('router')->generate('blog', array(
            'page' => 2,
            'category' => 'Symfony'
        ));
        //abs url
        $this->generateUrl('blog_show', array('slug' => 'my-blog-post'), true);
        //page68
    }
    public function serviceeAction(){
        $mailer = $this->get('my_mailer');
        $mailer->send();
    }
}


/**
 * @Route("/blog/{page}")
 */

/**
 * @Route("/blog/{page}", defaults={"page" = 1})
 */

/**
 * @Route("/blog/{page}", defaults={"page": 1}, requirements={
 * "page": "\d+"
 * })
 */

/**
 * @Route("/{_locale}", defaults={"_locale": "en"}, requirements={
 * "_locale": "en|fr"
 * })
 */

/**
 * @Route("/news")
 * @Method("GET","POST")
 */

/**
 * @Route(
 * "/articles/{_locale}/{year}/{title}.{_format}",
 * defaults={"_format": "html"},
 * requirements={
 * "_locale": "en|fr",
 * "_format": "html|rss",
 * "year": "\d+"
 * }
 * )
 */

//$ php app/console debug:router article_show
//$ php app/console router:match /blog/my-latest-post


//contact:
//  path: /contact
//  defaults: { _controller: AcmeDemoBundle:Main:contact }
//  condition: "context.getMethod() in ['GET', 'HEAD'] and
//      request.headers.get('User-Agent') matches '/firefox/i'"