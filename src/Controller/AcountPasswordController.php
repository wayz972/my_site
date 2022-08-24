<?php

namespace App\Controller;

use App\Form\ChangePassewordType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class AcountPasswordController extends AbstractController
{


private $doctrine;

public function __construct(EntityManagerInterface $doctrine ){
    $this->doctrine=$doctrine;

}

    #[Route('/compte/password', name: 'app_acount_password')]
    public function index(Request $request , UserPasswordHasherInterface $encoder): Response
    {
        $notification=null;
        $user=$this->getUser();
        $form=$this->createForm(ChangePassewordType::class,$user);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $old_password=$form->get('old_password')->getData();
          
            if($encoder->isPasswordValid($user, $old_password)){
               $new_password=$form->get('new_password')->getData();
               $password= $encoder->hashPassword($user,$new_password);
               $user->setPassword($password);
               $this->doctrine->persist($user);
               $this->doctrine->flush();
               $notification="votre mot de passe à bien été mise à jour";

            }else{
                $notification="votre mot de passe actuel n'est pas le bon";
            }

        }



        return $this->render('acount_password/index.html.twig', [
            'form'=>$form->createView(),
            'notification'=> $notification
        ]);
    }
}
