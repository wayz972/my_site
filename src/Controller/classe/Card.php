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

        $session = $this->requestStack->getSession()->get('card', []);
       // si mon id existe dans ma variable alors incremente la 
        if(!empty($session[$id])){
            $session[$id] ++;
        }else{
            //sinon joute la valzur un
            $session[$id]=1; 
        }
   // update mon panier
        $this->requestStack->getSession()->set('card',$session);
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