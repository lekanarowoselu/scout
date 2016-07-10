<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\PageCategory;
use ScoutBundle\Form\PageCategoryType;

/**
 * PageCategory controller.
 *
 */
class PageCategoryController extends Controller
{
    /**
     * Lists all PageCategory entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //$locale = $_GET['_locale'];
        $locale = $request->attributes->get('_locale');

        $pageCategories = $em->getRepository('ScoutBundle:PageCategory')->findByLang($locale);

        return $this->render('ScoutBundle:pagecategory:index.html.twig', array(
            'pageCategories' => $pageCategories,
            '_locale'=>  $locale
        ));
    }

    /**
     * Creates a new PageCategory entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $pageCategory = new PageCategory();
        $locale = $request->attributes->get('_locale');
        if($locale== 'fr')
        {
            $use_lang = 2;

                }else{

            $use_lang = 1;
        }
        $pageCategory->setLang($em->getRepository('ScoutBundle:Lang')->findOneBy(['locale' => $locale]));

        $form = $this->createForm('ScoutBundle\Form\PageCategoryType', $pageCategory,  array('locale' => $use_lang));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $slugged = $this->get('slugify');
            $slug = $slugged->slugify($form['slug']->getData(), '-');
            $pageCategory->setSlug($slug);
            $em = $this->getDoctrine()->getManager();
            
            
            
            $em->persist($pageCategory);
            $em->flush();

            return $this->redirectToRoute('pagecategory_show', array('id' => $pageCategory->getId()));
        }

        return $this->render('ScoutBundle:pagecategory:new.html.twig', array(
            'pageCategory' => $pageCategory,
            'form' => $form->createView(),
            '_locale'=>  $locale
        ));
    }

    /**
     * Finds and displays a PageCategory entity.
     *
     */
    public function showAction(PageCategory $pageCategory, Request $request)
    {
        $deleteForm = $this->createDeleteForm($pageCategory);
        $locale = $request->attributes->get('_locale');
        return $this->render('ScoutBundle:pagecategory:show.html.twig', array(
            'pageCategory' => $pageCategory,
            'delete_form' => $deleteForm->createView(),
            '_locale'=>  $locale
        ));
    }

    /**
     * Displays a form to edit an existing PageCategory entity.
     *
     */
    public function editAction(Request $request, PageCategory $pageCategory)
    {
       // $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($pageCategory);
        //$locale = $request->attributes->get('_locale');
        $data_lang = $pageCategory->getLang()->getId();
        $editForm = $this->createForm('ScoutBundle\Form\PageCategoryType', $pageCategory,  array('locale' => $data_lang));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $slugged = $this->get('slugify');
            $slug = $slugged->slugify($editForm['slug']->getData(), '-');
            $pageCategory->setSlug($slug);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pageCategory);
            $em->flush();


            return $this->redirectToRoute('pagecategory_show', array('id' => $pageCategory->getId()));
        }

        return $this->render('ScoutBundle:pagecategory:edit.html.twig', array(
            'pageCategory' => $pageCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
           
        ));
    }

    /**
     * Deletes a PageCategory entity.
     *
     */
    public function deleteAction(Request $request, PageCategory $pageCategory)
    {
        $form = $this->createDeleteForm($pageCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pageCategory);
            $em->flush();
        }

        return $this->redirectToRoute('pagecategory_index');
    }

    /**
     * Creates a form to delete a PageCategory entity.
     *
     * @param PageCategory $pageCategory The PageCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PageCategory $pageCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pagecategory_delete', array('id' => $pageCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
