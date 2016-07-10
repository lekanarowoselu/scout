<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\VillaBooking;
use ScoutBundle\Form\VillaBookingType;

/**
 * HouseBooking controller.
 *
 */
class HouseBookingController extends Controller
{
    /**
     * Lists all VillaBooking entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villaBookings = $em->getRepository('ScoutBundle:HouseBooking')->findAll();

        return $this->render('ScoutBundle:housebooking:index.html.twig', array(
            'houseBookings' => $houseBookings,
        ));
    }

    /**
     * Creates a new VillaBooking entity.
     *
     */
    public function newAction(Request $request)
    {
        $houseBooking = new VillaBooking();
        $form = $this->createForm('ScoutBundle\Form\VillaBookingType', $houseBooking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($houseBooking);
            $em->flush();

            return $this->redirectToRoute('housebooking_show', array('id' => $houseBooking->getId()));
        }

        return $this->render('ScoutBundle:housebooking:new.html.twig', array(
            'houseBooking' => $houseBooking,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VillaBooking entity.
     *
     */
    public function showAction(VillaBooking $houseBooking)
    {
        $deleteForm = $this->createDeleteForm($houseBooking);

        return $this->render('ScoutBundle:housebooking:show.html.twig', array(
            'houseBooking' => $houseBooking,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VillaBooking entity.
     *
     */
    public function editAction(Request $request, VillaBooking $houseBooking)
    {
        $deleteForm = $this->createDeleteForm($houseBooking);
        $editForm = $this->createForm('ScoutBundle\Form\VillaBookingType', $houseBooking);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($houseBooking);
            $em->flush();

            return $this->redirectToRoute('housebooking_edit', array('id' => $houseBooking->getId()));
        }

        return $this->render('ScoutBundle:housebooking:edit.html.twig', array(
            'houseBooking' => $houseBooking,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a HouseBooking entity.
     *
     */
    public function deleteAction(Request $request, HouseBooking $houseBooking)
    {
        $form = $this->createDeleteForm($houseBooking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($houseBooking);
            $em->flush();
        }

        return $this->redirectToRoute('housebooking_index');
    }

    /**
     * Creates a form to delete a HouseBooking entity.
     *
     * @param HouseBooking $houseBooking The HouseBooking entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(HouseBooking $houseBooking)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('housebooking_delete', array('id' => $houseBooking->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
