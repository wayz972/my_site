<?php


namespace App\Form;

use App\Classe\Search;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{

     //ici mon formulaire
    public function buildForm(FormBuilderInterface $builder, array $options): void

{
    $builder
    ->add('string',TextType::class,[
        'label'=>'recherche',
        'required'=>false,
        "attr"=>["placeholder"=>"votre de recherche ...",
        'class'=>'form-control-sm']
    ]) 
      //relier mon input a une entité
     ->add('categories',EntityType::class,[
        'label'=>false,
        'required'=>false,
        'class'=>Category::class,
        'multiple'=>true,  //tu peux selectionner plussieur valeur
        'expanded'=>true]  //une vue en checkbox 
        )
        ->add('submit',SubmitType::class,[
            'label'=>'filtrer',
            'attr'=>['class'=>'btn-info  btn-primary']

        ])
    ;


}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            //relier a ma class
            'data_class' => Search::class,
            'method'=>'GET',
            'crsf_protection'=> false, //cripatge
        ]);
    }

    //retourner un valeur dedans URL
    public function getBlockPrefix()
    {
      return '' ; //retourne rien  
    }
}