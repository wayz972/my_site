<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request ,ManagerRegistry $doctrine): Response
    {

        $user=new User();
        $form = $this->createForm( RegisterType::class ,$user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $user=$form->getData();
           $doctrines= $doctrine->getManager();
           $doctrines->persist($user);
           $doctrines->flush();
        }
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}