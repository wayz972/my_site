<?php

namespace App\Controller;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }




    #[Route('/api', name: 'app_home')]
    public function api(HttpClientInterface $client): Response
    {
  //appel a une api
  
        $this->client = $client;
        $response = $this->client->request('GET','https://calendly.com/api/v1/users/me/event_types?include=owner',[
            'headers'=>[
                'Content-Type'=>'application/json',
                'X-TOKEN'=>'QXLJSDIWTU6UHJILF5UN6RFETIOECRYD',
            ]
        ]
        );
        $content = $response->getContent();
        
      dd($content);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
