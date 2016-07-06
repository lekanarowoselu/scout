<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\VillaService;
use AppBundle\Form\VillaServiceType;

/**
 * VillaService controller.
 *
 */
class VillaServiceController extends Controller
{
    /**
     * Lists all VillaService entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villaServices = $em->getRepository('AppBundle:VillaService')->findAll();

        return $this->render('AppBundle:villaservice:index.html.twig', array(
            'villaServices' => $villaServices,
        ));
    }

    /**
     * Creates a new VillaService entity.
     *
     */
    public function newAction(Request $request)
    {
        $villaService = new VillaService();
        $form = $this->createForm('AppBundle\Form\VillaServiceType', $villaService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaService);
            $em->flush();

            return $this->redirectToRoute('villaservice_show', array('id' => $villaService->getId()));
        }

        return $this->render('AppBundle:villaservice:new.html.twig', array(
            'villaService' => $villaService,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a VillaService entity.
     *
     */
    public function showAction(VillaService $villaService)
    {
        $deleteForm = $this->createDeleteForm($villaService);

        return $this->render('AppBundle:villaservice:show.html.twig', array(
            'villaService' => $villaService,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing VillaService entity.
     *
     */
    public function editAction(Request $request, VillaService $villaService)
    {
        $deleteForm = $this->createDeleteForm($villaService);
        $editForm = $this->createForm('AppBundle\Form\VillaServiceType', $villaService);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villaService);
            $em->flush();

            return $this->redirectToRoute('villaservice_edit', array('id' => $villaService->getId()));
        }

        return $this->render('AppBundle:villaservice:edit.html.twig', array(
            'villaService' => $villaService,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a VillaService entity.
     *
     */
    public function deleteAction(Request $request, VillaService $villaService)
    {
        $form = $this->createDeleteForm($villaService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($villaService);
            $em->flush();
        }

        return $this->redirectToRoute('villaservice_index');
    }

    /**
     * Creates a form to delete a VillaService entity.
     *
     * @param VillaService $villaService The VillaService entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VillaService $villaService)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('villaservice_delete', array('id' => $villaService->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
