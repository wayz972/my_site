<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
{
    return [
        //je veux recuperer les information de ma class  product 'setIllustration'
       BeforeEntityPersistedEvent::class=>['setIllustration']
    ];
   
}
public function setIllustration(BeforeEntityPersistedEvent $event)
{
    $entity=$event->getEntityInstance();
    dd($entity);
}

}