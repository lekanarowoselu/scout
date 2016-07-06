<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Villa;
use AppBundle\Form\VillaType;

/**
 * Villa controller.
 *
 */
class VillaController extends Controller
{
    /**
     * Lists all Villa entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villas = $em->getRepository('AppBundle:Villa')->findAll();

        if(  $villas != null) {

            foreach ($villas as $villa) {

                $villaCategory[] = $villa->getCategories();
                $villaImage[] = $villa->getImages();

            }

            return $this->render('villa/index.html.twig', array(
                'villas' => $villas,
                'villaCategory' => $villaCategory,
                'villaImage' => $villaImage,
            ));
        }

        else{

            return $this->render('villa/index.html.twig', array(
                'villas' => $villas,

            ));}
    }


    /**
     * Finds and displays a Villa entity.
     *
     */
    public function showAction(Villa $villa)
    {
        $deleteForm = $this->createDeleteForm($villa);

        return $this->render('villa/show.html.twig', array(
            'villa' => $villa,
            'delete_form' => $deleteForm->createView(),
        ));
    }





    /**
     * Lists all Villa entities.
     *
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villas = $em->getRepository('AppBundle:Villa')->findAll();

//        if(  $villas != null) {
//
//            foreach ($villas as $villa) {
//
//                $villaCategory[] = $villa->getCategories();
//                $villaImage[] = $villa->getImages();
//
//            }

//            return $this->render('villa/index.html.twig', array(
//                'villas' => $villas,
////                'villaCategory' => $villaCategory,
////                'villaImage' => $villaImage,
//            ));
//        }

//        else{

            return $this->render('AppBundle:villa:index.html.twig', array(
                'villas' => $villas,

            ));
    //}
    }

    /**
     * Creates a new Villa entity.
     *
     */
    public function newAction(Request $request)
    {
        $villa = new Villa();
        $em = $this->getDoctrine()->getManager();
        $locale = $request->attributes->get('_locale');
        if($locale== 'fr')
        {
            $use_lang = 2;

        }else{

            $use_lang = 1;
        }
        $villa->setLang($em->getRepository('AppBundle:Lang')->findOneBy(['locale' => $locale]));
        
        
        
        
        $form = $this->createForm('AppBundle\Form\VillaType', $villa, array('locale' => $use_lang));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villa);
            $em->flush();

            return $this->redirectToRoute('villa_show', array('id' => $villa->getId()));
        }

        return $this->render('AppBundle:villa:new.html.twig', array(
            'villa' => $villa,
            'form' => $form->createView(),
            '_locale'=>  $locale
        ));
    }

    /**
     * Finds and displays a Villa entity.
     *
     */
    public function detailAction(Villa $villa)
    {
        $deleteForm = $this->createDeleteForm($villa);

        return $this->render('AppBundle:villa:show.html.twig', array(
            'villa' => $villa,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Villa entity.
     *
     */
    public function editAction(Request $request, Villa $villa)
    {
        $deleteForm = $this->createDeleteForm($villa);
        $editForm = $this->createForm('AppBundle\Form\VillaType', $villa);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villa);
            $em->flush();

            return $this->redirectToRoute('villa_edit', array('id' => $villa->getId()));
        }

        return $this->render('AppBundle:villa:edit.html.twig', array(
            'villa' => $villa,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Villa entity.
     *
     */
    public function deleteAction(Request $request, Villa $villa)
    {
        $form = $this->createDeleteForm($villa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($villa);
            $em->flush();
        }

        return $this->redirectToRoute('villa_list');
    }

    /**
     * Creates a form to delete a Villa entity.
     *
     * @param Villa $villa The Villa entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Villa $villa)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('villa_delete', array('id' => $villa->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
