<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\LandLord;
use ScoutBundle\Form\LandLordType;

/**
 * LandLord controller.
 *
 */
class LandLordController extends Controller
{
    /**
     * Lists all LandLord entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $landLords = $em->getRepository('ScoutBundle:LandLord')->findAll();

        return $this->render('landlord/index.html.twig', array(
            'landLords' => $landLords,
        ));
    }

    /**
     * Creates a new LandLord entity.
     *
     */
    public function newAction(Request $request)
    {
        $landLord = new LandLord();
        $form = $this->createForm('ScoutBundle\Form\LandLordType', $landLord);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($landLord);
            $em->flush();

            return $this->redirectToRoute('_show', array('id' => $landLord->getId()));
        }

        return $this->render('landlord/new.html.twig', array(
            'landLord' => $landLord,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a LandLord entity.
     *
     */
    public function showAction(LandLord $landLord)
    {
        $deleteForm = $this->createDeleteForm($landLord);

        return $this->render('landlord/show.html.twig', array(
            'landLord' => $landLord,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing LandLord entity.
     *
     */
    public function editAction(Request $request, LandLord $landLord)
    {
        $deleteForm = $this->createDeleteForm($landLord);
        $editForm = $this->createForm('ScoutBundle\Form\LandLordType', $landLord);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($landLord);
            $em->flush();

            return $this->redirectToRoute('_edit', array('id' => $landLord->getId()));
        }

        return $this->render('landlord/edit.html.twig', array(
            'landLord' => $landLord,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a LandLord entity.
     *
     */
    public function deleteAction(Request $request, LandLord $landLord)
    {
        $form = $this->createDeleteForm($landLord);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($landLord);
            $em->flush();
        }

        return $this->redirectToRoute('_index');
    }

    /**
     * Creates a form to delete a LandLord entity.
     *
     * @param LandLord $landLord The LandLord entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(LandLord $landLord)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $landLord->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
