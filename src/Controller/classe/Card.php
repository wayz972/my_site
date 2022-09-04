<?php
namespace App\Classe;


use Symfony\Component\HttpFoundation\RequestStack;

class Card
{

    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
 
    public function Add($id)
    {

        $session = $this->requestStack->getSession();

      $session->set('card',[
       'id'=>$id,
       'quantity'=>1
      ]);
    } 
    public function get(){

        $session = $this->requestStack->getSession();
        return $session->get('card');

    }

    public function remove()
    {
        $session = $this->requestStack->getSession();
        return $session->remove('card');
    }
}