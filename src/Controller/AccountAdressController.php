<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAdressController extends AbstractController
{
    #[Route('/compte/adresse', name: 'app_account_adress')]
    public function index(): Response
    {

        return $this->render('account_adress/index.html.twig', [
            'controller_name' => 'AccountAdressController',
        ]);
    }

    #[Route('/compte/ajouter_adresse', name: 'app_account_add_adresse')]
    public function add(): Response
    {
        $address = new Adresse();
        $form = $this->createForm(AdresseType::class, $address);
        return $this->render('account_adress/add_adresse.html.twig', [
            'form' =>$form->createView()
        ]);
    }
}
