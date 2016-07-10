<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\Lang;
use ScoutBundle\Form\LangType;

/**
 * Lang controller.
 *
 */
class LangController extends Controller
{
    /**
     * Lists all Lang entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $langs = $em->getRepository('ScoutBundle:Lang')->findAll();

        return $this->render('ScoutBundle:lang:index.html.twig', array(
            'langs' => $langs,
        ));
    }

    /**
     * Creates a new Lang entity.
     *
     */
    public function newAction(Request $request)
    {
        $lang = new Lang();
        $form = $this->createForm('ScoutBundle\Form\LangType', $lang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lang);
            $em->flush();

            return $this->redirectToRoute('lang_show', array('id' => $lang->getId()));
        }

        return $this->render('ScoutBundle:lang:new.html.twig', array(
            'lang' => $lang,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Lang entity.
     *
     */
    public function showAction(Lang $lang)
    {
        $deleteForm = $this->createDeleteForm($lang);

        return $this->render('ScoutBundle:lang:show.html.twig', array(
            'lang' => $lang,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Lang entity.
     *
     */
    public function editAction(Request $request, Lang $lang)
    {
        $deleteForm = $this->createDeleteForm($lang);
        $editForm = $this->createForm('ScoutBundle\Form\LangType', $lang);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lang);
            $em->flush();

            return $this->redirectToRoute('lang_show', array('id' => $lang->getId()));
        }

        return $this->render('ScoutBundle:lang:edit.html.twig', array(
            'lang' => $lang,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Lang entity.
     *
     */
    public function deleteAction(Request $request, Lang $lang)
    {
        $form = $this->createDeleteForm($lang);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lang);
            $em->flush();
        }

        return $this->redirectToRoute('lang_index');
    }

    /**
     * Creates a form to delete a Lang entity.
     *
     * @param Lang $lang The Lang entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lang $lang)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lang_delete', array('id' => $lang->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
