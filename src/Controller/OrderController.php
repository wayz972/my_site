<?php

namespace App\Controller;

use App\Classe\Card;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/commande', name: 'app_order')]
    public function index(Card $card,Request $request): Response
    {

if(!$this->getUser()->getadresses()->getValues()){
    return $this->redirectToRoute('app_account_add_adresse');
}

        $form= $this->createForm(OrderType::class,null,[
            'user'=>$this->getUser()


        ]);
        //la validation de mon formulaire
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

        dd($form->getData());
        }
        return $this->render('order/index.html.twig', [
            'form'=>$form->createView(),
            //je passe mon panier card avec le methode getfull
            'card'=>$card->getFull()
          
        ]);
    }
}
