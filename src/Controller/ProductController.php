<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

  //je crée une variable 
    private $entitymanager;
    //j'appel la methode entitymanager pour faire appel a ma connection
    public function __construct(EntityManagerInterface $entitymanager)
    {
       $this-> entitymanager= $entitymanager;
    }


    #[Route('/nos-produits', name: 'app_products')]
    public function index(): Response
    {
     //je vais chercher la class grace a la methode getrepository
       $products= $this->entitymanager->getRepository(Product::class)->findAll();

 

        return $this->render('product/index.html.twig', [
        'products'=>$products    
        ]);
    }
}
