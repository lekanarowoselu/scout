<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VillaAmenity;
use AppBundle\Form\VillaAmenityType;

/**
 * VillaAmenity controller.
 *
 */
class VillaAmenityController extends Controller
{
    /**
     * Lists all VillaAmenity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villaAmenities = $em->getRepository('AppBundle:VillaAmenity')->findAll();

        return $this->render('AppBundle:villaamenity:index.html.twig', array(
            'villaAmenities' => $villaAmenities,
        ));
    }

    /**
     * Creates a new VillaAmenity entity.
     *
     */
    public function newAction(Request $request)
    {
        $villaAmenity = new VillaAmenity();
        $form = $this->createForm('AppBundle\Form\VillaAmenityType', $villaAmenity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaAmenity);
            $em->flush();

            return $this->redirectToRoute('villaamenity_show', array('id' => $villaAmenity->getId()));
        }

        return $this->render('AppBundle:villaamenity:new.html.twig', array(
            'villaAmenity' => $villaAmenity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VillaAmenity entity.
     *
     */
    public function showAction(VillaAmenity $villaAmenity)
    {
        $deleteForm = $this->createDeleteForm($villaAmenity);

        return $this->render('AppBundle:villaamenity:show.html.twig', array(
            'villaAmenity' => $villaAmenity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VillaAmenity entity.
     *
     */
    public function editAction(Request $request, VillaAmenity $villaAmenity)
    {
        $deleteForm = $this->createDeleteForm($villaAmenity);
        $editForm = $this->createForm('AppBundle\Form\VillaAmenityType', $villaAmenity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaAmenity);
            $em->flush();

            return $this->redirectToRoute('villaamenity_edit', array('id' => $villaAmenity->getId()));
        }

        return $this->render('AppBundle:villaamenity:edit.html.twig', array(
            'villaAmenity' => $villaAmenity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VillaAmenity entity.
     *
     */
    public function deleteAction(Request $request, VillaAmenity $villaAmenity)
    {
        $form = $this->createDeleteForm($villaAmenity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($villaAmenity);
            $em->flush();
        }

        return $this->redirectToRoute('villaamenity_index');
    }

    /**
     * Creates a form to delete a VillaAmenity entity.
     *
     * @param VillaAmenity $villaAmenity The VillaAmenity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VillaAmenity $villaAmenity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('villaamenity_delete', array('id' => $villaAmenity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
