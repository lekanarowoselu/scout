<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\MailingList;
use ScoutBundle\Form\MailingListType;

/**
 * MailingList controller.
 *
 */
class MailingListController extends Controller
{
    /**
     * Lists all MailingList entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mailingLists = $em->getRepository('ScoutBundle:MailingList')->findAll();

        return $this->render('ScoutBundle:mailinglist:index.html.twig', array(
            'mailingLists' => $mailingLists,
        ));
    }

    /**
     * Creates a new MailingList entity.
     *
     */
    public function newAction(Request $request)
    {
        $mailingList = new MailingList();
        $form = $this->createForm('ScoutBundle\Form\MailingListType', $mailingList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mailingList);
            $em->flush();

            return $this->redirectToRoute('mailinglist_show', array('id' => $mailingList->getId()));
        }

        return $this->render('ScoutBundle:mailinglist:new.html.twig', array(
            'mailingList' => $mailingList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a MailingList entity.
     *
     */
    public function showAction(MailingList $mailingList)
    {
        $deleteForm = $this->createDeleteForm($mailingList);

        return $this->render('mailinglist/show.html.twig', array(
            'mailingList' => $mailingList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MailingList entity.
     *
     */
    public function editAction(Request $request, MailingList $mailingList)
    {
        $deleteForm = $this->createDeleteForm($mailingList);
        $editForm = $this->createForm('ScoutBundle\Form\MailingListType', $mailingList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mailingList);
            $em->flush();

            return $this->redirectToRoute('mailinglist_edit', array('id' => $mailingList->getId()));
        }

        return $this->render('ScoutBundle:mailinglist:edit.html.twig', array(
            'mailingList' => $mailingList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MailingList entity.
     *
     */
    public function deleteAction(Request $request, MailingList $mailingList)
    {
        $form = $this->createDeleteForm($mailingList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mailingList);
            $em->flush();
        }

        return $this->redirectToRoute('mailinglist_index');
    }

    /**
     * Creates a form to delete a MailingList entity.
     *
     * @param MailingList $mailingList The MailingList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MailingList $mailingList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mailinglist_delete', array('id' => $mailingList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
