<?php

namespace App\Controller;

use App\Classe\Card;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    #[Route('/mon-panier', name: 'app_card')]
    public function index(Card $card): Response
    {

       dd( $card->get());
        return $this->render('card/index.html.twig', [
            
        ]);
    }


    #[Route('/card/add/{id}', name: 'add_card')]
    public function add(Card $card,$id): Response
    {


     $card->Add($id);
      

          return $this->redirectToRoute('app_card');
    }

    #[Route('/card/remove', name: 'remove_card')]
    public function Remove(Card $card): Response
    {


     $card->remove();
      
       
          return $this->redirectToRoute('app_products');
    }
}
