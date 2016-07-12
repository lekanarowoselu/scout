<?php
// src/Acme/UserBundle/Controller/RegistrationController.php

namespace AuthBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Security\Core\Exception\AccessDeniedException;
//use FOS\UserBundle\Model\UserInterface;
class RegistrationController extends BaseController
{


    public function registerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

      // $user->addRole(ROLE :"ROLE_ADMIN")
       // $user->setRoles(array('ROLE_ADMIN'));
        //$user->setRoles(array('ROLE_USER'));

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            //$user->setRoles(array('ROLE_ADMIN', 'ROLE_USER'));
//           $usertype =  $form['usertype']->getData();
//            if($usertype == 3){$user->addRole('ROLE_COMPANY');}
//            if($usertype == 2){$user->addRole('ROLE_JOBSEEKER');}
//            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {

                $this->addFlash(
                    'notice',
                    'Your Registration has been confirmed and you are logged in(remember to send registration email or even activation )'
                );
                //$url = $this->generateUrl('fos_user_registration_confirmed');
                $url = $this->generateUrl('scout_homepage');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('AuthBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * Tell the user to check his email provider
     */
    public function checkEmailAction()
    {
        $email = $this->get('session')->get('fos_user_send_confirmation_email/email');
        $this->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }
        $this->addFlash(
            'notice',
            'An email has been sent to '. $user->getEmail() .' It contains an activation link you must click to activate your account.'
        );
//        return $this->render('OctopouceAuthBundle:Security:login.html.twig', array(
//            'user' => $user,
//        ));

        return $this->redirectToRoute('scout_homepage');
    }
}