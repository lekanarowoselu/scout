<?php

namespace AppBundle\Controller;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VillaCategory;
use AppBundle\Form\VillaCategoryType;

/**
 * VillaCategory controller.
 *
 */
class VillaCategoryController extends Controller
{
    /**
     * Lists all VillaCategory entities.
     *
     */
    public function indexAction()
    {


        $em = $this->getDoctrine()->getManager();

        $villaCategories = $em->getRepository('AppBundle:VillaCategory')->findAll();

        return $this->render('villacategory/index.html.twig', array(
            'villaCategories' => $villaCategories,
        ));
    }

    /**
     * Lists all VillaCategory entities.
     *
     */
    public function listAction()
    {


        $em = $this->getDoctrine()->getManager();

        $villaCategories = $em->getRepository('AppBundle:VillaCategory')->findAll();

        return $this->render('AppBundle:villacategory:index.html.twig', array(
            'villaCategories' => $villaCategories,
        ));
    }
    /**
     * Creates a new VillaCategory entity.
     *
     */
    public function newAction(Request $request)
        
    {
        $em = $this->getDoctrine()->getManager();
        $villaCategory = new VillaCategory();
        $locale = $request->attributes->get('_locale');
        if($locale== 'fr')
        {
            $use_lang = 2;

        }else{

            $use_lang = 1;
        }
        $villaCategory->setLang($em->getRepository('AppBundle:Lang')->findOneBy(['locale' => $locale]));

        $form = $this->createForm('AppBundle\Form\VillaCategoryType',  $villaCategory,  array('locale' => $use_lang));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $slugged = $this->get('slugify');

            $slug = $slugged->slugify($form['name']->getData(), '-');


            $villaCategory->setSlug($slug);
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaCategory);
            $em->flush();

            return $this->redirectToRoute('villacategory_show', array('id' => $villaCategory->getId()));
        }

        return $this->render('AppBundle:villacategory:new.html.twig', array(
            'villaCategory' => $villaCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VillaCategory entity.
     *
     */
    public function showAction(VillaCategory $villaCategory)
    {
        $deleteForm = $this->createDeleteForm($villaCategory);

        return $this->render('villacategory/show.html.twig', array(
            'villaCategory' => $villaCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Finds and displays a VillaCategory entity.
     *
     */
    public function detailAction(VillaCategory $villaCategory)
    {
        $deleteForm = $this->createDeleteForm($villaCategory);

        return $this->render('AppBundle:villacategory:show.html.twig', array(
            'villaCategory' => $villaCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing VillaCategory entity.
     *
     */
    public function editAction(Request $request, VillaCategory $villaCategory)
    {
        $deleteForm = $this->createDeleteForm($villaCategory);
      
        $data_lang = $villaCategory->getLang()->getId();
        $editForm = $this->createForm('AppBundle\Form\VillaCategoryType', $villaCategory,  array('locale' => $data_lang));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaCategory);
            $em->flush();

            return $this->redirectToRoute('villacategory_edit', array('id' => $villaCategory->getId()));
        }

        return $this->render('AppBundle:villacategory:edit.html.twig', array(
            'villaCategory' => $villaCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VillaCategory entity.
     *
     */
    public function deleteAction(Request $request, VillaCategory $villaCategory)
    {
        $form = $this->createDeleteForm($villaCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($villaCategory);
            $em->flush();
        }

        return $this->redirectToRoute('villacategory_index');
    }

    /**
     * Creates a form to delete a VillaCategory entity.
     *
     * @param VillaCategory $villaCategory The VillaCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VillaCategory $villaCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('villacategory_delete', array('id' => $villaCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
