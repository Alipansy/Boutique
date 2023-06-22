<?php

namespace App\Controller;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request; // Correction ici
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    
#[Route('/app', name:'home')]
public function cart(ProduitRepository $repo, Request $request): Response
{
    $produits = $repo->findAll();
    dump($produits);
    return $this->render('base.html.twig', [
        'produit' => $produits
    ]);
}
}
