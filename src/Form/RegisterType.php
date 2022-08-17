<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                "label"=>"votre Email",
                "attr"=>["placeholder"=>"merci de saisir votre email"]

            ])
          
            ->add('firstname', TextType::class,[
                "label"=>"votre prénom",
                "attr"=>["placeholder"=>"merci de saisir votre prénom"]
            ])
            ->add('lastname',TextType::class,[
                "label"=>"votre nom",
                "attr"=>["placeholder"=>"merci de saisir votre nom"]
            ])
              ->add('password',PasswordType::class,[
                "label"=>"votre mot passe",
                "attr"=>["placeholder"=>"merci de saisir votre mot de passe "]
            ])
            ->add('passeword_confirm',PasswordType::class,[
                "label"=>"confirmez votre mot de passe",
                'mapped'=>false,
                "attr"=>["placeholder"=>"merci de saisir de nouveau votre  mot de passe "]
            ])
            ->add('submit',SubmitType::class,[
                "label"=>"s'incrire"
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
