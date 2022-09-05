<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

   //je crée une variable 
   private $entitymanager;
   //j'appel la methode entitymanager pour faire appel a ma connection
   public function __construct(EntityManagerInterface $entitymanager)
   {
      $this->entitymanager = $entitymanager;
   }


   #[Route('/nos-produits', name: 'app_products')]
   public function index(Request $request): Response
   {

      //initialiser ma class
      $search = new Search();
      // je lui passe le methode createForm a ma class 
      $form = $this->createForm(SearchType::class, $search);

      //methode handlerequest ->ecoute la requete de mon formulaire 
      $form->handleRequest($request);

      // si il est soumit et valide alors 
      if ($form->isSubmitted() && $form->isValid()) {
         // on appel notre class repository avec une methode et je lui passe la varaible search
         $products = $this->entitymanager->getRepository(Product::class)->findWidthSearch($search);
      } else {

         //je vais chercher la class grace a la methode getrepository et j'affiche tout mes produits
         $products = $this->entitymanager->getRepository(Product::class)->findAll();
      }
      return $this->render('product/index.html.twig', [
         'products' => $products,
         'form' => $form->createView()
      ]);
   }



   #[Route('/nos-produit/{slug}', name: 'app_product')]
   public function show($slug): Response
   {


      //je vais chercher la class grace a la methode getrepository methode findOneBySlug
      $product = $this->entitymanager->getRepository(Product::class)->findOneBySlug($slug);

      //si il renvoie null alors fait une redirection
      if (!$product) {
         return $this->redirectToRoute('app_products');
      }

      return $this->render('product/show.html.twig', [
         'product' => $product
      ]);
   }
}
