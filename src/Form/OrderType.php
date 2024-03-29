<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
       
        //je recuperer info de mon user dans option 
        $user=$options['user'];
        $builder
            ->add('addresses',EntityType::class,[
                "label"=>"choisissez votre adresse de livraison",
                "required"=>true,
                "choices"=>$user->getadresses(),// je passe le user
                "class"=>Adresse::class,
                "multiple"=>false,
                "expanded"=>true
            ])
            ->add('carriers',EntityType::class,[
                "label"=>"choisissez votre transporteur ",
                "required"=>true,
                "class"=>Carrier::class,
                "multiple"=>false,
                "expanded"=>true
            ])
            ->add('submit',SubmitType::class,[
                "label"=>"valider ma commande",
                "attr"=>[
                    "class"=>"btn btn-success btn-block"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'user'=>array()
        ]);
    }
}
