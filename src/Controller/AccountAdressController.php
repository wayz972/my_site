<?php

namespace App\Controller;

use App\Classe\Card;
use App\Entity\Adresse;
use App\Form\AdresseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAdressController extends AbstractController
{

private EntityManagerInterface $EntityManager ;
public function __construct(EntityManagerInterface $EntityManager )
{
   $this->EntityManager=$EntityManager;
}

    #[Route('/compte/adresse', name: 'app_account_adress')]
    public function index(): Response
    {

        return $this->render('account_adress/index.html.twig', [
            'controller_name' => 'AccountAdressController',
        ]);
    }

    #[Route('/compte/ajouter_adresse', name: 'app_account_add_adresse')]
    public function add(Card $card,Request $request): Response
    {

        $address = new Adresse();
        $form = $this->createForm(AdresseType::class, $address);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
           
           $address->setUser($this->getUser());
          
            $this->EntityManager->persist($address);
            $this->EntityManager->flush();
            if($card->get()){
                return $this->redirectToRoute('app_order');
            }else{

                return $this->redirectToRoute('app_account_adress');
            }
        
        }
        return $this->render('account_adress/add_adresse.html.twig', [
            'form' =>$form->createView()
        ]);
    }
    #[Route('/compte/modifier_adresse/{id}', name: 'app_account_add_adresse_edit')]
    public function edit(Request $request,$id): Response
    {
        $address =  $this->EntityManager->getRepository(Adresse::class)->findOneById($id);
       
        if(!$address || $address->getUser() != $this->getUser())
        {
            return $this->redirectToRoute('app_account_adress');
        }
        $form = $this->createForm(AdresseType::class, $address);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
           
            $this->EntityManager->flush();
            return $this->redirectToRoute('app_account_adress');
        
        }
        return $this->render('account_adress/add_adresse.html.twig', [
            'form' =>$form->createView()
        ]);
    }
    #[Route('/compte/supprimer_une_adresse/{id}', name: 'app_account_adresse_delete')]
    public function delete($id): Response
    {
        $address =  $this->EntityManager->getRepository(Adresse::class)->findOneById($id);
       
        if($address && $address->getUser() == $this->getUser())
        {
            $this->EntityManager->remove($address);
            $this->EntityManager->flush();
            return $this->redirectToRoute('app_account_adress');
        }
        
           
           
            return $this->redirectToRoute('app_account_adress');
        
        
    }
}
