<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\House;
use ScoutBundle\Form\HouseType;

/**
 * House controller.
 *
 */
class HouseController extends Controller
{
    /**
     * Lists all House entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $houses = $em->getRepository('ScoutBundle:House')->findAll();

        return $this->render('house/index.html.twig', array(
            'houses' => $houses,
        ));
    }

    /**
     * Creates a new House entity.
     *
     */
    public function newAction(Request $request)
    {
        $house = new House();
        $form = $this->createForm('ScoutBundle\Form\HouseType', $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($house);
            $em->flush();

            return $this->redirectToRoute('_show', array('id' => $house->getId()));
        }

        return $this->render('house/new.html.twig', array(
            'house' => $house,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a House entity.
     *
     */
    public function showAction(House $house)
    {
        $deleteForm = $this->createDeleteForm($house);

        return $this->render('house/show.html.twig', array(
            'house' => $house,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing House entity.
     *
     */
    public function editAction(Request $request, House $house)
    {
        $deleteForm = $this->createDeleteForm($house);
        $editForm = $this->createForm('ScoutBundle\Form\HouseType', $house);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($house);
            $em->flush();

            return $this->redirectToRoute('_edit', array('id' => $house->getId()));
        }

        return $this->render('house/edit.html.twig', array(
            'house' => $house,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a House entity.
     *
     */
    public function deleteAction(Request $request, House $house)
    {
        $form = $this->createDeleteForm($house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($house);
            $em->flush();
        }

        return $this->redirectToRoute('_index');
    }

    /**
     * Creates a form to delete a House entity.
     *
     * @param House $house The House entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(House $house)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $house->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
