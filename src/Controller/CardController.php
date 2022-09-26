<?php

namespace App\Controller;

use App\Classe\Card;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class CardController extends AbstractController
{
private $entityManager;

public function __construct(ManagerRegistry $entityManager)
{
   $this->entityManager=$entityManager;
}

    #[Route('/mon-panier', name: 'app_card')]
    public function index(Card $card): Response
    {
  
        return $this->render('card/index.html.twig', [
             'card'=> $card->getFull(),
        ]);
    }


    #[Route('/card/add/{id}', name: 'add_card')]
    public function add(Card $card,$id): Response
    {

  
     $card->Add($id);
 
      

          return $this->redirectToRoute('app_card');
    }



    #[Route('/card/removefull', name: 'removefull_card')]
    public function RemoveFull(Card $card): Response
    {


     $card->removeFull();
      
       
          return $this->redirectToRoute('app_card');
    }

    #[Route('/card/remove', name: 'remove_card')]
    public function Remove(Card $card): Response
    {


     $card->remove();
      
       
          return $this->redirectToRoute('app_products');
    }

    #[Route('/card/delete{id}', name: 'delete_to_card')]
    public function delete(Card $card,$id): Response
    {


     $card->delete($id);
      
       
          return $this->redirectToRoute('app_card');
    }
}
