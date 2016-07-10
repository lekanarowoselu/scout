<?php

namespace ScoutBundle\Controller;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\HouseCategory;
use ScoutBundle\Form\HouseCategoryType;

/**
 * HouseCategory controller.
 *
 */
class HouseCategoryController extends Controller
{
    /**
     * Lists all HouseCategory entities.
     *
     */
    public function indexAction()
    {


        $em = $this->getDoctrine()->getManager();

        $houseCategories = $em->getRepository('ScoutBundle:HouseCategory')->findAll();

        return $this->render('housecategory/index.html.twig', array(
            'houseCategories' => $houseCategories,
        ));
    }

    /**
     * Lists all HouseCategory entities.
     *
     */
    public function listAction()
    {


        $em = $this->getDoctrine()->getManager();

        $houseCategories = $em->getRepository('ScoutBundle:HouseCategory')->findAll();

        return $this->render('ScoutBundle:housecategory:index.html.twig', array(
            'houseCategories' => $houseCategories,
        ));
    }
    /**
     * Creates a new HouseCategory entity.
     *
     */
    public function newAction(Request $request)
        
    {
        $em = $this->getDoctrine()->getManager();
        $houseCategory = new HouseCategory();
        $locale = $request->attributes->get('_locale');
        if($locale== 'fr')
        {
            $use_lang = 2;

        }else{

            $use_lang = 1;
        }
        $houseCategory->setLang($em->getRepository('ScoutBundle:Lang')->findOneBy(['locale' => $locale]));

        $form = $this->createForm('ScoutBundle\Form\HouseCategoryType',  $houseCategory,  array('locale' => $use_lang));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $slugged = $this->get('slugify');

            $slug = $slugged->slugify($form['name']->getData(), '-');


            $houseCategory->setSlug($slug);
            $em = $this->getDoctrine()->getManager();
            $em->persist($houseCategory);
            $em->flush();

            return $this->redirectToRoute('housecategory_show', array('id' => $houseCategory->getId()));
        }

        return $this->render('ScoutBundle:housecategory:new.html.twig', array(
            'houseCategory' => $houseCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a HouseCategory entity.
     *
     */
    public function showAction(HouseCategory $houseCategory)
    {
        $deleteForm = $this->createDeleteForm($houseCategory);

        return $this->render('housecategory/show.html.twig', array(
            'houseCategory' => $houseCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * Finds and displays a HouseCategory entity.
     *
     */
    public function detailAction(HouseCategory $houseCategory)
    {
        $deleteForm = $this->createDeleteForm($houseCategory);

        return $this->render('ScoutBundle:housecategory:show.html.twig', array(
            'houseCategory' => $houseCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing HouseCategory entity.
     *
     */
    public function editAction(Request $request, HouseCategory $houseCategory)
    {
        $deleteForm = $this->createDeleteForm($houseCategory);
      
        $data_lang = $houseCategory->getLang()->getId();
        $editForm = $this->createForm('ScoutBundle\Form\HouseCategoryType', $houseCategory,  array('locale' => $data_lang));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($houseCategory);
            $em->flush();

            return $this->redirectToRoute('housecategory_edit', array('id' => $houseCategory->getId()));
        }

        return $this->render('ScoutBundle:housecategory:edit.html.twig', array(
            'houseCategory' => $houseCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a HouseCategory entity.
     *
     */
    public function deleteAction(Request $request, HouseCategory $houseCategory)
    {
        $form = $this->createDeleteForm($houseCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($houseCategory);
            $em->flush();
        }

        return $this->redirectToRoute('housecategory_index');
    }

    /**
     * Creates a form to delete a HouseCategory entity.
     *
     * @param HouseCategory $houseCategory The HouseCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(HouseCategory $houseCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('housecategory_delete', array('id' => $houseCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
