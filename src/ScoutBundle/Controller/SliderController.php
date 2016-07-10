<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\Slider;
use ScoutBundle\Form\SliderType;

/**
 * Slider controller.
 *
 */
class SliderController extends Controller
{
    /**
     * Lists all Slider entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sliders = $em->getRepository('ScoutBundle:Slider')->findAll();

        return $this->render('ScoutBundle:slider:index.html.twig', array(
            'sliders' => $sliders,
        ));
    }

    /**
     * Creates a new Slider entity.
     *
     */
    public function newAction(Request $request)
    {
        $slider = new Slider();

        $em = $this->getDoctrine()->getManager();
        $locale = $request->attributes->get('_locale');

        //$slider->setLang($em->getRepository('ScoutBundle:Lang')->findOneBy(['locale' => $locale]));
        $slides = $em->getRepository('ScoutBundle:Image')->findAll();
        
        $form = $this->createForm('ScoutBundle\Form\SliderType', $slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();

            return $this->redirectToRoute('slider_show', array('id' => $slider->getId()));
        }

        return $this->render('ScoutBundle:slider:new.html.twig', array(
            'slider' => $slider,
            'form' => $form->createView(),
            '_locale'=>  $locale,
            'slides' => $slides
        ));
    }

    /**
     * Finds and displays a Slider entity.
     *
     */
    public function showAction(Slider $slider)
    {
        $deleteForm = $this->createDeleteForm($slider);

        return $this->render('ScoutBundle:slider:show.html.twig', array(
            'slider' => $slider,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Slider entity.
     *
     */
    public function editAction(Request $request, Slider $slider)
    {
        $deleteForm = $this->createDeleteForm($slider);
        $editForm = $this->createForm('ScoutBundle\Form\SliderType', $slider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();

            return $this->redirectToRoute('slider_edit', array('id' => $slider->getId()));
        }

        return $this->render('ScoutBundle:slider:edit.html.twig', array(
            'slider' => $slider,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Slider entity.
     *
     */
    public function deleteAction(Request $request, Slider $slider)
    {
        $form = $this->createDeleteForm($slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($slider);
            $em->flush();
        }

        return $this->redirectToRoute('slider_index');
    }

    /**
     * Creates a form to delete a Slider entity.
     *
     * @param Slider $slider The Slider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Slider $slider)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('slider_delete', array('id' => $slider->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
