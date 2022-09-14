<?php

namespace App\Classe;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\Persistence\ManagerRegistry;

class Card
{

    private $requestStack;
    private $entityManager;

    public function __construct(RequestStack $requestStack, ManagerRegistry $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    public function Add($id)
    {

        $session = $this->requestStack->getSession()->get('card', []);

        // si mon id existe dans ma variable alors incremente la 

        if (!empty($session[$id])) {

            $session[$id]++;
        } else {
            //sinon joute la valeur un
            $session[$id] = 1;
        }
        // update mon panier
        $this->requestStack->getSession()->set('card', $session);
    }
    public function get()
    {

        $session = $this->requestStack->getSession();
        return $session->get('card');
    }

    public function remove()
    {
        $session = $this->requestStack->getSession();
        return $session->remove('card');
    }

    public function delete($id)
    {
        $session = $this->requestStack->getSession()->get('card', []);

        unset($session[$id]);
        return $this->requestStack->getSession()->set('card', $session);
    }

    public function getFull()
    {
        $cardComplet = [];

        if (!empty($this->get())) {

            foreach ($this->get() as $id => $quantity) {

                $product_objet = $this->entityManager->getRepository(Product::class)->find($id);
                if (!$product_objet) {
                    $this->delete($id);
                    continue;
                }
                $cardComplet[] = [
                    'product' => $product_objet,
                    'quantity' => $quantity,
                ];
            }
        }
        return $cardComplet;
    }



    public function removeFull()
    {
        return $session = $this->requestStack->getSession()->remove('card');
        
    }
}
