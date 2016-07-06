<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VillaLocation;
use AppBundle\Form\VillaLocationType;

/**
 * VillaLocation controller.
 *
 */
class VillaLocationController extends Controller
{
    /**
     * Lists all VillaLocation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villaLocations = $em->getRepository('AppBundle:VillaLocation')->findAll();

        return $this->render('AppBundle:villalocation:index.html.twig', array(
            'villaLocations' => $villaLocations,
        ));
    }

    /**
     * Creates a new VillaLocation entity.
     *
     */
    public function newAction(Request $request)
    {
        $villaLocation = new VillaLocation();
        $form = $this->createForm('AppBundle\Form\VillaLocationType', $villaLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaLocation);
            $em->flush();

            return $this->redirectToRoute('villalocation_show', array('id' => $villaLocation->getId()));
        }

        return $this->render('AppBundle:villalocation:new.html.twig', array(
            'villaLocation' => $villaLocation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VillaLocation entity.
     *
     */
    public function showAction(VillaLocation $villaLocation)
    {
        $deleteForm = $this->createDeleteForm($villaLocation);

        return $this->render('AppBundle:villalocation:show.html.twig', array(
            'villaLocation' => $villaLocation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VillaLocation entity.
     *
     */
    public function editAction(Request $request, VillaLocation $villaLocation)
    {
        $deleteForm = $this->createDeleteForm($villaLocation);
        $editForm = $this->createForm('AppBundle\Form\VillaLocationType', $villaLocation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaLocation);
            $em->flush();

            return $this->redirectToRoute('villalocation_edit', array('id' => $villaLocation->getId()));
        }

        return $this->render('AppBundle:villalocation:edit.html.twig', array(
            'villaLocation' => $villaLocation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VillaLocation entity.
     *
     */
    public function deleteAction(Request $request, VillaLocation $villaLocation)
    {
        $form = $this->createDeleteForm($villaLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($villaLocation);
            $em->flush();
        }

        return $this->redirectToRoute('villalocation_index');
    }

    /**
     * Creates a form to delete a VillaLocation entity.
     *
     * @param VillaLocation $villaLocation The VillaLocation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VillaLocation $villaLocation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('villalocation_delete', array('id' => $villaLocation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
