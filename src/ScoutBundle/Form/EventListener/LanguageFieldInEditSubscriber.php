<?php
/**
 * Created by PhpStorm.
 * User: dev2
 * Date: 16/06/16
 * Time: 16:16
 */

namespace AppBundle\Form\EventListener;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\PageCategoryRepository;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LanguageFieldInEditSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        //$locale = 2;

        // check if the object is "new"
        // If you didn't pass any data to the form, the data is "null".
        // This should be considered a new object
        if (!$data || !$data->getId()) {
            $form->add('lang', null, ['disabled' => true]);
            //$form->add('translations');
        }
        else
        {

                //If PHP < 5.4
            //$form->add('lang', null, array('disabled' => true));
            //If PHP >= 5.4
            $form->add('lang', null, ['disabled' => true]);

//            $form->add('translations',  EntityType::class, array(
//                'class' => 'AppBundle:PageCategory',
//                'query_builder' => function(PageCategoryRepository $repository) use ($locale) {
//                    $qb = $repository->createQueryBuilder("u");
//                    return $qb->where($qb->expr()->neq('u.lang', $locale));
//                    // ->getQuery()->getResult();
////            ->setParameter("locale",  $options["locale"]);
//
//
//
//                },
//            )
//        );

        }
    }

}
