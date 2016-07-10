<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\HouseLocation;
use ScoutBundle\Form\HouseLocationType;

/**
 * HouseLocation controller.
 *
 */
class HouseLocationController extends Controller
{
    /**
     * Lists all HouseLocation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $houseLocations = $em->getRepository('ScoutBundle:HouseLocation')->findAll();

        return $this->render('ScoutBundle:houselocation:index.html.twig', array(
            'houseLocations' => $houseLocations,
        ));
    }

    /**
     * Creates a new houseLocation entity.
     *
     */
    public function newAction(Request $request)
    {
        $houseLocation = new HouseLocation();
        $form = $this->createForm('ScoutBundle\Form\HouseLocationType', $houseLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($houseLocation);
            $em->flush();

            return $this->redirectToRoute('houselocation_show', array('id' => $houseLocation->getId()));
        }

        return $this->render('ScoutBundle:houselocation:new.html.twig', array(
            'houseLocation' => $houseLocation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VhouseLocation entity.
     *
     */
    public function showAction(houseLocation $houseLocation)
    {
        $deleteForm = $this->createDeleteForm($houseLocation);

        return $this->render('ScoutBundle:houselocation:show.html.twig', array(
            'houseLocation' => $houseLocation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing houseLocation entity.
     *
     */
    public function editAction(Request $request, houseLocation $houseLocation)
    {
        $deleteForm = $this->createDeleteForm($houseLocation);
        $editForm = $this->createForm('ScoutBundle\Form\houseLocationType', $houseLocation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($houseLocation);
            $em->flush();

            return $this->redirectToRoute('houselocation_edit', array('id' => $houseLocation->getId()));
        }

        return $this->render('ScoutBundle:houselocation:edit.html.twig', array(
            'houseLocation' => $houseLocation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a houseLocation entity.
     *
     */
    public function deleteAction(Request $request, HouseLocation $houseLocation)
    {
        $form = $this->createDeleteForm($houseLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($houseLocation);
            $em->flush();
        }

        return $this->redirectToRoute('houselocation_index');
    }

    /**
     * Creates a form to delete a houseLocation entity.
     *
     * @param houseLocation $houseLocation The houseLocation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(HouseLocation $houseLocation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('houselocation_delete', array('id' => $houseLocation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
