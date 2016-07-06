<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Testimonial;
use AppBundle\Form\TestimonialType;

/**
 * Testimonial controller.
 *
 */
class TestimonialController extends Controller
{
    /**
     * Lists all Testimonial entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $testimonials = $em->getRepository('AppBundle:Testimonial')->findAll();

        return $this->render('testimonial/index.html.twig', array(
            'testimonials' => $testimonials,
        ));
    }

    /**
     * Creates a new Testimonial entity.
     *
     */
    public function newAction(Request $request)
    {
        $testimonial = new Testimonial();
        $form = $this->createForm('AppBundle\Form\TestimonialType', $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($testimonial);
            $em->flush();

            return $this->redirectToRoute('testimonial_show', array('id' => $testimonial->getId()));
        }

        return $this->render('testimonial/_new.html.twig', array(
            'testimonial' => $testimonial,
            'form' => $form->createView(),
        ));
    }


    public function createAction(Request $request)
    {

        //This is optional. Do not do this check if you want to call the same action using a regular request.
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }

        $testimonial = new Testimonial();
        $form = $this->createForm('AppBundle\Form\TestimonialType', $testimonial);
        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($contact);
//            $em->flush();
//
//            return $this->redirectToRoute('contact_show', array('id' => $contact->getId()));
//        }



        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($testimonial);
            $em->flush();

            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        $response = new JsonResponse(
            array(
                'message' => 'Error',
                'form' => $this->renderView('testimonial/index.html.twig',
                    array(
                        'entity' =>  $testimonial,
                        'form' => $form->createView(),
                    ))), 400);

        return $response;
    }


    /**
     * Finds and displays a Testimonial entity.
     *
     */
    public function showAction(Testimonial $testimonial)
    {
        $deleteForm = $this->createDeleteForm($testimonial);

        return $this->render('testimonial/show.html.twig', array(
            'testimonial' => $testimonial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Testimonial entity.
     *
     */
    public function editAction(Request $request, Testimonial $testimonial)
    {
        $deleteForm = $this->createDeleteForm($testimonial);
        $editForm = $this->createForm('AppBundle\Form\TestimonialType', $testimonial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($testimonial);
            $em->flush();

            return $this->redirectToRoute('testimonial_edit', array('id' => $testimonial->getId()));
        }

        return $this->render('testimonial/edit.html.twig', array(
            'testimonial' => $testimonial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Testimonial entity.
     *
     */
    public function deleteAction(Request $request, Testimonial $testimonial)
    {
        $form = $this->createDeleteForm($testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($testimonial);
            $em->flush();
        }

        return $this->redirectToRoute('testimonial_index');
    }

    /**
     * Creates a form to delete a Testimonial entity.
     *
     * @param Testimonial $testimonial The Testimonial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Testimonial $testimonial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('testimonial_delete', array('id' => $testimonial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
