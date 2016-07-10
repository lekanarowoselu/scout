<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\HouseAmenity;
use ScoutBundle\Form\HouseAmenityType;

/**
 * HouseAmenity controller.
 *
 */
class HouseAmenityController extends Controller
{
    /**
     * Lists all HouseAmenity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $houseAmenities = $em->getRepository('ScoutBundle:HouseAmenity')->findAll();

        return $this->render('ScoutBundle:houseamenity:index.html.twig', array(
            'houseAmenities' => $houseAmenities,
        ));
    }

    /**
     * Creates a new HouseAmenity entity.
     *
     */
    public function newAction(Request $request)
    {
        $houseAmenity = new HouseAmenity();
        $form = $this->createForm('ScoutBundle\Form\HouseAmenityType', $houseAmenity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($houseAmenity);
            $em->flush();

            return $this->redirectToRoute('houseamenity_show', array('id' => $houseAmenity->getId()));
        }

        return $this->render('ScoutBundle:houseamenity:new.html.twig', array(
            'houseAmenity' => $houseAmenity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a HouseAmenity entity.
     *
     */
    public function showAction(HouseAmenity $houseAmenity)
    {
        $deleteForm = $this->createDeleteForm($houseAmenity);

        return $this->render('ScoutBundle:houseamenity:show.html.twig', array(
            'houseAmenity' => $houseAmenity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing HouseAmenity entity.
     *
     */
    public function editAction(Request $request, HouseAmenity $houseAmenity)
    {
        $deleteForm = $this->createDeleteForm($houseAmenity);
        $editForm = $this->createForm('ScoutBundle\Form\HouseAmenityType', $houseAmenity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($houseAmenity);
            $em->flush();

            return $this->redirectToRoute('houseamenity_edit', array('id' => $houseAmenity->getId()));
        }

        return $this->render('ScoutBundle:houseamenity:edit.html.twig', array(
            'houseAmenity' => $houseAmenity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a HouseAmenity entity.
     *
     */
    public function deleteAction(Request $request, HouseAmenity $houseAmenity)
    {
        $form = $this->createDeleteForm($houseAmenity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($houseAmenity);
            $em->flush();
        }

        return $this->redirectToRoute('houseamenity_index');
    }

    /**
     * Creates a form to delete a HouseAmenity entity.
     *
     * @param HouseAmenity $houseAmenity The HouseAmenity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(HouseAmenity $houseAmenity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('houseamenity_delete', array('id' => $houseAmenity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
