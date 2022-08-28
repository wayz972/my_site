<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $appKernel;
    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
    }


    public static function getSubscribedEvents()
    {
        return [
            //je veux recuperer les information de ma class  product 'setIllustration'
            BeforeEntityPersistedEvent::class => ['setIllustration']
        ];
    }
    public function setIllustration(BeforeEntityPersistedEvent $event)
    {
        //je recupere les info de mon enttity
        $entity = $event->getEntityInstance();
        //je vais recuperer image ade mon entité avec get 
        $tmp_name = $entity->getIllustration();




        $extension = pathinfo($tmp_name, PATHINFO_EXTENSION);


        $projet_Dir = $this->appKernel->getProjectDir();

        $filename = uniqid();
  
         move_uploaded_file($tmp_name,$projet_Dir.'/public/uploads/'.$filename.'.'.$extension);
        
         $entity->setIllustration($filename.'.'.$extension);
    }
}
