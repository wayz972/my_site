<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name' ,TextType::class,[
                'label'=> 'quel nom souhaitez-vous donner à votre adresse?',
                'attr'=>[
                    'placeholder'=>'nommez votre adresse'
                ]
            ])
            ->add('firstname' ,TextType::class,[
                'label'=> 'votre prénom',
                'attr'=>[
                    'placeholder'=>'Entrez votre prénom'
                ]
            ])
            ->add('lastname' ,TextType::class,[
                'label'=> 'votre nom',
                'attr'=>[
                    'placeholder'=>'Entrez votre nom'
                ]
            ])
            ->add('company' ,TextType::class,[
                'label'=> 'Votre société?',
                'attr'=>[
                    'placeholder'=>'(facultatif)Entrez votre société'
                ]
            ])
            ->add('adress' ,TextType::class,[
                'label'=> 'votre Adresse',
                'attr'=>[
                    'placeholder'=>'8 rue des lylas .....'
                ]
            ])
            ->add('postal' ,TextType::class,[
                'label'=> 'votre code postal',
                'attr'=>[
                    'placeholder'=>'Entrez votre code postal'
                ]
            ])
            ->add('city' ,TelType::class,[
                'label'=> 'votre Ville',
                'attr'=>[
                    'placeholder'=>'Entrez votre ville'
                ]
            ])
            ->add('country' ,CountryType::class,[
                'label'=> 'Votre pays',
                'attr'=>[
                    'placeholder'=>'Entrez votre pays'
                ]
            ])
            ->add('phone' ,TextType::class,[
                'label'=> 'votre téléphone',
                'attr'=>[
                    'placeholder'=>'Entrez votre téléphone'
                ]
            ])
            ->add("submit",SubmitType::class , options: [
                "label"=>'Ajouter mon adresse',
                'attr'=>[
                    'class'=>'btn-block btn-info'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
