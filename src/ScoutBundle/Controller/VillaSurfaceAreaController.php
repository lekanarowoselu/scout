<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VillaSurfaceArea;
use AppBundle\Form\VillaSurfaceAreaType;

/**
 * VillaSurfaceArea controller.
 *
 */
class VillaSurfaceAreaController extends Controller
{
    /**
     * Lists all VillaSurfaceArea entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villaSurfaceAreas = $em->getRepository('AppBundle:VillaSurfaceArea')->findAll();

        return $this->render('AppBundle:villasurfacearea:index.html.twig', array(
            'villaSurfaceAreas' => $villaSurfaceAreas,
        ));
    }

    /**
     * Creates a new VillaSurfaceArea entity.
     *
     */
    public function newAction(Request $request)
    {
        $villaSurfaceArea = new VillaSurfaceArea();
        $form = $this->createForm('AppBundle\Form\VillaSurfaceAreaType', $villaSurfaceArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaSurfaceArea);
            $em->flush();

            return $this->redirectToRoute('villasurfacearea_show', array('id' => $villaSurfaceArea->getId()));
        }

        return $this->render('AppBundle:villasurfacearea:new.html.twig', array(
            'villaSurfaceArea' => $villaSurfaceArea,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VillaSurfaceArea entity.
     *
     */
    public function showAction(VillaSurfaceArea $villaSurfaceArea)
    {
        $deleteForm = $this->createDeleteForm($villaSurfaceArea);

        return $this->render('AppBundle:villasurfacearea:show.html.twig', array(
            'villaSurfaceArea' => $villaSurfaceArea,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VillaSurfaceArea entity.
     *
     */
    public function editAction(Request $request, VillaSurfaceArea $villaSurfaceArea)
    {
        $deleteForm = $this->createDeleteForm($villaSurfaceArea);
        $editForm = $this->createForm('AppBundle\Form\VillaSurfaceAreaType', $villaSurfaceArea);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaSurfaceArea);
            $em->flush();

            return $this->redirectToRoute('villasurfacearea_edit', array('id' => $villaSurfaceArea->getId()));
        }

        return $this->render('AppBundle:villasurfacearea:edit.html.twig', array(
            'villaSurfaceArea' => $villaSurfaceArea,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VillaSurfaceArea entity.
     *
     */
    public function deleteAction(Request $request, VillaSurfaceArea $villaSurfaceArea)
    {
        $form = $this->createDeleteForm($villaSurfaceArea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($villaSurfaceArea);
            $em->flush();
        }

        return $this->redirectToRoute('villasurfacearea_index');
    }

    /**
     * Creates a form to delete a VillaSurfaceArea entity.
     *
     * @param VillaSurfaceArea $villaSurfaceArea The VillaSurfaceArea entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VillaSurfaceArea $villaSurfaceArea)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('villasurfacearea_delete', array('id' => $villaSurfaceArea->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
