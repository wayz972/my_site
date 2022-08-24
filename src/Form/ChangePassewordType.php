<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePassewordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
               'disabled'=>true

            ])
            
            ->add('firstname',TextType::class,[
                'disabled'=>true
            ])
            ->add('lastname' ,TextType::class,[
                'disabled'=>true
            ])
            ->add('old_password',PasswordType::class,[
                'label'=>'saisir votre mot de passe',
                'mapped'=>false,
                'attr'=>[
                    "placeholder"=>'veuillez saisir votre mot de passe '
                ]
            ])
            ->add('new_password',RepeatedType::class,[
                'type'=>PasswordType::class,
                'mapped'=>false,
                'invalid_message'=>'le mot de passse et la confirmation doit etre identique',
                "label"=>"votre mot passe",
                'required'=>true,
                "first_options"=>["label"=>"mon nouveau mot de passe ",
                "attr"=>["placeholder"=>"merci de saisir votre nouveau  mot de passe"]],
                "second_options"=>['label'=>'confirmer votre mot de passe',
                "attr"=>["placeholder"=>"merci de confirmer votre nouveau  mot de passe"]],         
                 ])
                 ->add('submit',SubmitType::class,[
                    "label"=>"enregistrer"
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
