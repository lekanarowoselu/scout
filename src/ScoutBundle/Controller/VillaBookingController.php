<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VillaBooking;
use AppBundle\Form\VillaBookingType;

/**
 * VillaBooking controller.
 *
 */
class VillaBookingController extends Controller
{
    /**
     * Lists all VillaBooking entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villaBookings = $em->getRepository('AppBundle:VillaBooking')->findAll();

        return $this->render('AppBundle:villabooking:index.html.twig', array(
            'villaBookings' => $villaBookings,
        ));
    }

    /**
     * Creates a new VillaBooking entity.
     *
     */
    public function newAction(Request $request)
    {
        $villaBooking = new VillaBooking();
        $form = $this->createForm('AppBundle\Form\VillaBookingType', $villaBooking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaBooking);
            $em->flush();

            return $this->redirectToRoute('villabooking_show', array('id' => $villaBooking->getId()));
        }

        return $this->render('AppBundle:villabooking:new.html.twig', array(
            'villaBooking' => $villaBooking,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VillaBooking entity.
     *
     */
    public function showAction(VillaBooking $villaBooking)
    {
        $deleteForm = $this->createDeleteForm($villaBooking);

        return $this->render('AppBundle:villabooking:show.html.twig', array(
            'villaBooking' => $villaBooking,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VillaBooking entity.
     *
     */
    public function editAction(Request $request, VillaBooking $villaBooking)
    {
        $deleteForm = $this->createDeleteForm($villaBooking);
        $editForm = $this->createForm('AppBundle\Form\VillaBookingType', $villaBooking);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaBooking);
            $em->flush();

            return $this->redirectToRoute('villabooking_edit', array('id' => $villaBooking->getId()));
        }

        return $this->render('AppBundle:villabooking:edit.html.twig', array(
            'villaBooking' => $villaBooking,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VillaBooking entity.
     *
     */
    public function deleteAction(Request $request, VillaBooking $villaBooking)
    {
        $form = $this->createDeleteForm($villaBooking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($villaBooking);
            $em->flush();
        }

        return $this->redirectToRoute('villabooking_index');
    }

    /**
     * Creates a form to delete a VillaBooking entity.
     *
     * @param VillaBooking $villaBooking The VillaBooking entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VillaBooking $villaBooking)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('villabooking_delete', array('id' => $villaBooking->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
