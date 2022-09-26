<?php

namespace App\Controller;

use App\Classe\Axios;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TestAxiosController extends AbstractController
{
    #[Route('/axios', name: 'app_test_axios')]
    public function index(Axios $axios): Response
    {
        
        // dd($axios->Test());
    
  
        return $this->render('test_axios/index.html.twig', [
            'controller_name' => 'TestAxiosController',
        ]);
    }




    #[Route('/ax', name: 'app_test_ax')]
    public function ax(Request $request): Response
    {

       
            $data =  $request->getContent();
            $data = json_decode($data, true);
            
           
           var_dump($data);
          

       
        
    
  
        return $this->render('test_axios/index.html.twig', [
            'controller_name' => "hello"
        ]);
    }








    #[Route('/client', name: 'app__axios')]
    public function client(HttpClientInterface $client): Response
    {
      


        $this->client = $client;
        $url ='https://api.calendly.com/scheduled_events';
        $response = $this->client->request(
            'GET',$url
            ,[
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization'=> 'Bearer eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNjYzMTM2OTg0LCJqdGkiOiI5MWEwMWNkMy1hYWZkLTRjNWYtYmY2NC03NmQxMWUxM2UwNTkiLCJ1c2VyX3V1aWQiOiJjMTYzNzUwYy1lZGMwLTQ2OTctOTgxYy1mNDMyOWMwYWZlN2EifQ.T4lZIfE2gnaJTMsgpYz9Rk6QJePI9UyfXUCJBYZ_s-b5wsqrQVu-RaViKVsx0thtzW1MJDhzVIan0sYw4hqx1g'
                ],
                'query' => ['organization' => 'https://api.calendly.com/organizations/32026984-8c1e-430f-ad63-a102392f19a4',
                 'status'=>'active',
                 'sort'=>'start_time:desc',
                 'count'=>'100'
     
                ],
            ]
        );
        
     
        // $contentType = 'application/json'
        // $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
         $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
     
        //   dd( $content['collection']);
         foreach ($content['collection'] as $key => $value) {
            $uri = substr(strrchr(parse_url($value['uri'], PHP_URL_PATH),'/'),1);
            $event=substr(strrchr(parse_url($value['event_type'], PHP_URL_PATH),'/'),1);
            $uuid= substr(strrchr(parse_url($value["event_memberships"][0]['user'], PHP_URL_PATH),'/'),1);
          
            
     $url= "https://api.calendly.com/scheduled_events/$uri/invitees";
     
            $response1 = $this->client->request(
                'GET',
                $url,[
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Authorization'=> 'Bearer eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNjYzMTM2OTg0LCJqdGkiOiI5MWEwMWNkMy1hYWZkLTRjNWYtYmY2NC03NmQxMWUxM2UwNTkiLCJ1c2VyX3V1aWQiOiJjMTYzNzUwYy1lZGMwLTQ2OTctOTgxYy1mNDMyOWMwYWZlN2EifQ.T4lZIfE2gnaJTMsgpYz9Rk6QJePI9UyfXUCJBYZ_s-b5wsqrQVu-RaViKVsx0thtzW1MJDhzVIan0sYw4hqx1g'
                    ],
                   
                ]
            );
     
     
            // $content1 = $response1->getContent();
             $content1 = $response1->toArray();
            //  dd($content1);
     
     
     
     
            $url2= "https://api.calendly.com/event_types/$event";          
     
     
     $response2 = $this->client->request(
     'GET',
     $url2,[
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization'=> 'Bearer eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNjYzMTM2OTg0LCJqdGkiOiI5MWEwMWNkMy1hYWZkLTRjNWYtYmY2NC03NmQxMWUxM2UwNTkiLCJ1c2VyX3V1aWQiOiJjMTYzNzUwYy1lZGMwLTQ2OTctOTgxYy1mNDMyOWMwYWZlN2EifQ.T4lZIfE2gnaJTMsgpYz9Rk6QJePI9UyfXUCJBYZ_s-b5wsqrQVu-RaViKVsx0thtzW1MJDhzVIan0sYw4hqx1g'
        ],
       
     ]
     );
     
     
     // $content2 = $response2->getContent();
     $content2 = $response2->toArray();

     
     $resultat = array("utilisateur"=>$content2["resource"]["profile"]["name"],
     "uuid"=>$uuid,"scheduled_events"=>$uri,'start_time'=>date('Y-m-d h:i:s', strtotime($value['start_time'])),'end_time'=>date('Y-m-d h:i:s', strtotime($value['end_time'])),"type d'evenement"=>$value['name'],"email"=>$content1["collection"][0]["email"],"name"=>$content1["collection"][0]["name"],"first_name"=>$content1["collection"][0]["first_name"],"last_name"=>$content1["collection"][0]["last_name"],"question"=>$content1["collection"][0]["questions_and_answers"]);



     
     
     };
     
         




        return $this->render('test_axios/index.html.twig', [
            'controller_name' => 'TestAxiosController',
            'resultat'=>"hello",
        ]);
    }





}
