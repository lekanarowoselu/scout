<?php

namespace ScoutBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ScoutBundle\Entity\Settings;
use ScoutBundle\Form\SettingsType;

/**
 * Settings controller.
 *
 */
class SettingsController extends Controller
{
    /**
     * Lists all Settings entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $settings = $em->getRepository('ScoutBundle:Settings')->findAll();

        return $this->render('ScoutBundle:settings:index.html.twig', array(
            'settings' => $settings,
        ));
    }

    /**
     * Creates a new Settings entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $setting = new Settings();
        $locale = $request->attributes->get('_locale');
        $setting->setLang($em->getRepository('ScoutBundle:Lang')->findOneBy(['locale' => $locale]));
        $form = $this->createForm('ScoutBundle\Form\SettingsType', $setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($setting);
            $em->flush();

            return $this->redirectToRoute('settings_show', array('id' => $setting->getId()));
        }

        return $this->render('ScoutBundle:settings:new.html.twig', array(
            'setting' => $setting,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Settings entity.
     *
     */
    public function displayAction(Request $request)
    {
       // $deleteForm = $this->createDeleteForm($setting);
        $em = $this->getDoctrine()->getManager();
        $locale = $request->attributes->get('_locale');
        $setting = $em->getRepository('ScoutBundle:Settings')->findByLang($locale);
        return $this->render('settings/_show.html.twig', array(
            'setting' => $setting,
            //'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Finds and displays a Settings entity.
     *
     */
    public function showAction(Settings $setting)
    {
        $deleteForm = $this->createDeleteForm($setting);

        return $this->render('ScoutBundle:settings:show.html.twig', array(
            'setting' => $setting,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Settings entity.
     *
     */
    public function editAction(Request $request, Settings $setting)
    {
        $deleteForm = $this->createDeleteForm($setting);
        
        $editForm = $this->createForm('ScoutBundle\Form\SettingsType', $setting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($setting);
            $em->flush();

            return $this->redirectToRoute('settings_show', array('id' => $setting->getId()));
        }

        return $this->render('ScoutBundle:settings:edit.html.twig', array(
            'setting' => $setting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Settings entity.
     *
     */
    public function deleteAction(Request $request, Settings $setting)
    {
        $form = $this->createDeleteForm($setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($setting);
            $em->flush();
        }

        return $this->redirectToRoute('settings_index');
    }

    /**
     * Creates a form to delete a Settings entity.
     *
     * @param Settings $setting The Settings entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Settings $setting)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('settings_delete', array('id' => $setting->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
