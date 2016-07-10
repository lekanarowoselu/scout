<?php

namespace ScoutBundle\Controller\Site;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

//    public function indexAction(Request $request)
//    {
//        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
//        ]);
//    }
//
    public function indexAction(Request $request)
    {
//       
        $em = $this->getDoctrine()->getManager();
        $locale = $request->attributes->get('_locale');

       // $homepage = $em->getRepository('ScoutBundle:Page')->findOneByPageName("homepage", $locale);

        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
           //'homepage'=>$homepage
        ]);
    }


    public function langAction()

    {

//        return $this->redirectToRoute('app_index', array('_locale' => 'en'));
        return $this->redirectToRoute('app_index');
    }

    public function adminAction()

    {

        return $this->render('AppBundle:admin:index.html.twig');
    }

    public function menuAction(Request $request, $_route)
    {

        $em = $this->getDoctrine()->getManager();
        $locale = $request->attributes->get('_locale');

        $villaCategories = $em->getRepository('AppBundle:VillaCategory')->findAllByLang($locale);

        //$villaCategories = $em->getRepository('AppBundle:VillaCategory')->findAll();

       // $langManager = $this->container->get("web.translate.service");
        //$locale = $langManager->getLang();
       // $locale = $request->attributes->get('_locale');
//        $servicePages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Service");
//        $smartbuyPages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Smartbuy");
        $pagecategories = $em->getRepository('AppBundle:PageCategory')->findAllByLang($locale);
//        foreach ($pagecategories as $category) {
//            //echo $category->getTitle();
//          $pages =  $category->getPages();
////            foreach($pages as $page){
////                //echo $page->getTitle();
////                // echo $page->getSlug();
////
////            }
//        }


        //$pages = $em->getRepository('AppBundle:Page')->findAllByLangugae($locale);

        return $this->render('default/menu.html.twig', array(
            "categories" => $villaCategories,
           "pagecategories" => $pagecategories,
//            "smartbuyPages" => $smartbuyPages,
            "_route"=>$_route,

        ));
    }

    public function sideMenuAction(Request $request, $_route)
    {

//        $em = $this->getDoctrine()->getManager();
//        $villaCategories = $em->getRepository('AppBundle:VillaCategory')->findAll();
//
//        $locale = $request->attributes->get('_locale');
//       $servicePages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Service");
//       $smartBuyPages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Smartbuy");
//        $pageCategories = $em->getRepository('AppBundle:PageCategory')->findAllByLang($locale);
//
//
//        return $this->render('default/sidemenu.html.twig', array(
//            "villaCategories" => $villaCategories,
//            "pageCategories" => $pageCategories,
//           "smartBuyPages" => $smartBuyPages,
//            "_route"=>$_route,
//            "servicePages" => $servicePages
//
//        ));

        $em = $this->getDoctrine()->getManager();
        $villaCategories = $em->getRepository('AppBundle:VillaCategory')->findAll();

        // $langManager = $this->container->get("web.translate.service");
        //$locale = $langManager->getLang();
        $locale = $request->attributes->get('_locale');
        $servicePages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Service");
        $smartbuyPages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Smartbuy");
        $pagecategories = $em->getRepository('AppBundle:PageCategory')->findAllByLang($locale);
//        foreach ($pagecategories as $category) {
//            //echo $category->getTitle();
//          $pages =  $category->getPages();
////            foreach($pages as $page){
////                //echo $page->getTitle();
////                // echo $page->getSlug();
////
////            }
//        }


        //$pages = $em->getRepository('AppBundle:Page')->findAllByLangugae($locale);

        return $this->render('default/sidemenu.html.twig', array(
            "categories" => $villaCategories,
            "pagecategories" => $pagecategories,
            "servicePages" => $servicePages,
            "smartbuyPages" => $smartbuyPages,
            "_route"=>$_route,

        ));
    }





    public function footerMenuAction(Request $request, $_route)
    {

//        $em = $this->getDoctrine()->getManager();
//        $villaCategories = $em->getRepository('AppBundle:VillaCategory')->findAll();
//
//        $locale = $request->attributes->get('_locale');
//       $servicePages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Service");
//       $smartBuyPages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Smartbuy");
//        $pageCategories = $em->getRepository('AppBundle:PageCategory')->findAllByLang($locale);
//
//
//        return $this->render('default/sidemenu.html.twig', array(
//            "villaCategories" => $villaCategories,
//            "pageCategories" => $pageCategories,
//           "smartBuyPages" => $smartBuyPages,
//            "_route"=>$_route,
//            "servicePages" => $servicePages
//
//        ));

        $em = $this->getDoctrine()->getManager();
        $locale = $request->attributes->get('_locale');

        $villaCategories = $em->getRepository('AppBundle:VillaCategory')->findAllByLang($locale);

//        $servicePages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Service");
//        $smartbuyPages = $em->getRepository('AppBundle:Page')->findByCategoryName($locale, "Smartbuy");
        $pagecategories = $em->getRepository('AppBundle:PageCategory')->findAllByLang($locale);
//        foreach ($pagecategories as $category) {
//            //echo $category->getTitle();
//          $pages =  $category->getPages();
////            foreach($pages as $page){
////                //echo $page->getTitle();
////                // echo $page->getSlug();
////
////            }
//        }


        //$pages = $em->getRepository('AppBundle:Page')->findAllByLangugae($locale);

        return $this->render('default/footermenu.html.twig', array(
            "categories" => $villaCategories,
            "pagecategories" => $pagecategories,

            "_route"=>$_route,

        ));
    }

    public function removeTrailingSlashAction(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $requestUri = $request->getRequestUri();

        $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);

        return $this->redirect($url, 301);
    }

}