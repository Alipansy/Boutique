<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(RequestStack $rs, ProduitRepository $repo): Response
    {
        $montant = 0;
        $session = $rs->getSession();
        $cart = $session->get('cart', []);
        $cartWithData = [];


        foreach ($cart as $id => $quantite) {
            $produit = $repo->find($id);
            $cartWithData[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
            $montant = $produit->getPrix() * $quantite;
        }
        return $this->render('cart/index.html.twig', [
            'items' => $cartWithData,
            'montant' => $montant
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add($id, RequestStack $rs): Response
    {
        $session = $rs->getSession();
        $qt = $session->get('qt', 0);
        $cart = $session->get('cart', []);
        if (!empty($cart[$id])) {
            $cart[$id]++;
            $qt++;
        } else {
            $cart[$id] = 1;
            $qt++;
        }
        $session->set('cart', $cart);
        $session->set('qt', $qt);
        // dd($session->get('cart'));
        return $this->render('app_cart');
    }
    
    #[Route('/cart/minus/{id}', name:'cart_minus')]
    public function minus($id, RequestStack $rs)
    {
        //nous récupérons ou créons la session grâce à nla classe request stack (service)
        $session = $rs->getSession();
        $cart = $session->get('cart', []);
        $qt= $session->get('qt',0); 

        // va me chercher l'indice cart dans la session, si elle n'existe pas, creer la, je recupere la session 'cart'
        //dans mon tableau $cart, à la case $id, je donne la valeur 1
        if(!empty($cart[$id]) && $cart[$id] > 1)
        {
            $cart[$id]--;
            $qt--;
        }else
        {
            unset($cart[$id]);
        //  return $this->redirectToRoute('cart_remove');
        }
        
       
        $session->set('cart', $cart); 
        //je sauvegarde l'etat de mon panier à l'attribut de session 'cart'

        // dd($session->get('cart'));
        return $this->redirectToRoute('app_cart');
    }
}
