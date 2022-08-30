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



    #[Route('/nos-produit/{slug}', name: 'app_product')]
    public function show($slug): Response
    {




     //je vais chercher la class grace a la methode getrepository methode findOneBySlug
      $product= $this->entitymanager->getRepository(Product::class)->findOneBySlug($slug);

 //si il renvoie null alors fait une redirection
 if(!$product){
    return $this->redirectToRoute('app_products');
 }

        return $this->render('product/show.html.twig', [
         'product'=>$product    
        ]);
    }
}
