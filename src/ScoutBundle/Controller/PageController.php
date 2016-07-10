<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\Page;
use ScoutBundle\Form\PageType;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{
    /**
     * Lists all Page entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $locale = $request->attributes->get('_locale');
       // $pages = $em->getRepository('ScoutBundle:Page')->findAll();
        $pages = $em->getRepository('ScoutBundle:Page')->findByLang($locale);

        return $this->render('ScoutBundle:page:index.html.twig', array(
            'pages' => $pages,
            '_locale'=>  $locale
        ));
    }

    /**
     * Creates a new Page entity.
     *
     */
    public function newAction(Request $request)
    {
        $page = new Page();
        $em = $this->getDoctrine()->getManager();
        $locale = $request->attributes->get('_locale');
        if($locale== 'fr')
        {
            $use_lang = 2;

        }else{

            $use_lang = 1;
        }
        $page->setLang($em->getRepository('ScoutBundle:Lang')->findOneBy(['locale' => $locale]));
        $form = $this->createForm('ScoutBundle\Form\PageType', $page, array('locale' => $use_lang));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slugged = $this->get('slugify');
            $slug = $slugged->slugify($form['slug']->getData(), '-');

           
            $page->setSlug($slug);

            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('page_detail', array('id' => $page->getId()));
        }

        return $this->render('ScoutBundle:page:new.html.twig', array(
            'page' => $page,
            'form' => $form->createView(),
            '_locale'=>  $locale
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction($slug)


    {


        $em = $this->getDoctrine()->getManager();
  

        /*
         * i Get my current page
         */
        $page = $em->getRepository('ScoutBundle:Page')->findOneBySlug($slug);
        /*
         * i build translation link for my current page
         */

       // if(!empty( $pageslider))
        $pagesliders = $page->getSlider();
        if(!empty( $pagesliders))
        {$pageslider = $pagesliders;}
        else{
            $pageslider = $em->getRepository('ScoutBundle:Slider')->find(1); }

        
        $translationsLink = false;
        $translations = $page->getTranslations();

        if(!empty($translations) and count($translations) > 0){
            $translation = $translations[0]; //TODO : have to be dynamise if you want to manage more than 1 langage
            $translationsLink = $this->generateUrl('page_show',['_locale' => $translation->getLang(),'slug' => $translation->getSlug()]);
        }else{
            $translationsLink = $this->generateUrl('page_show',['_locale' => $page->getLang(),'slug' => $page->getSlug()]);}


        //die($page->getLang());
        //$lastestnews = $em->getRepository('WebBundle:Page')->findLatestNews($locale,$this->arrayCategoryNewsTitle[$locale]);
        //cant stay like this
        //$social = $em->getRepository("WebBundle:SocialEntry")->findOneBy([],["publishedAt" => "DESC"]);
//        if( $page->getLang() == $locale)
//        {
//            $pager = $page;
//        }else{
//
//            $translations = $page->getTranslations();
//            if(!empty($translations)){
//                $pager = $translations[0];
//            }
//        }
//              $servicePages = $em->getRepository('ScoutBundle:Page')->findByCategoryName($locale, "Service");
//      $smartbuyPages = $em->getRepository('ScoutBundle:Page')->findByCategoryName($locale, "Smartbuy");

        return $this->render('page/show.html.twig', array(
            'page' => $page,
            'translationsLink' => $translationsLink,
            'pageslider' => $pageslider
        ));


    }


    public function detailAction(Request $request, Page $page)


    {
        $deleteForm = $this->createDeleteForm($page);
//
//        return $this->render('page/show.html.twig', array(
//            'page' => $page,
//            'delete_form' => $deleteForm->createView(),
//        ));
        //$locale = $request->attributes->get('_locale');

        //$em = $this->getDoctrine()->getManager();
        //$langManager = $this->container->get("web.translate.service");
        //$locale = $langManager->getLang();
        //$page = $em->getRepository('ScoutBundle:Page')->findOneBy($_locale);
        //$lastestnews = $em->getRepository('WebBundle:Page')->findLatestNews($locale,$this->arrayCategoryNewsTitle[$locale]);
        //cant stay like this
        //$social = $em->getRepository("WebBundle:SocialEntry")->findOneBy([],["publishedAt" => "DESC"]);

        return $this->render('ScoutBundle:page:show.html.twig', array(
            'page' => $page,
            'delete_form' => $deleteForm->createView(),
        ));



    }
    /**
     * Displays a form to edit an existing Page entity.
     *
     */
    public function editAction(Request $request, Page $page)
    {

        $locale = $request->attributes->get('_locale');
        if($locale== 'fr')
        {
            $use_lang = 2;

        }else{

            $use_lang = 1;
        }
        $deleteForm = $this->createDeleteForm($page);
        $editForm = $this->createForm('ScoutBundle\Form\PageType', $page, array('locale' => $use_lang));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('page_detail', array('id' => $page->getId()));
        }

        return $this->render('ScoutBundle:page:edit.html.twig', array(
            'page' => $page,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction(Request $request, Page $page)
    {
        $form = $this->createDeleteForm($page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($page);
            $em->flush();
        }

        return $this->redirectToRoute('page_index');
    }

    /**
     * Creates a form to delete a Page entity.
     *
     * @param Page $page The Page entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Page $page)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('page_delete', array('id' => $page->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
