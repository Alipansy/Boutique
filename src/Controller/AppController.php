<?php

namespace App\Controller;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; // Correction ici
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    
#[Route('/', name:'home')]
public function cart(ProduitRepository $repo, Request $request): Response
{
    $produits = $repo->findAll();
    
    return $this->render('base.html.twig', [
        'produit' => $produits
    ]);
}
#[Route("/main/profil", name:"profil")]
    public function profil(CommandeRepository $repo)
    {
        $commandes = $repo->findBy(['user' => $this->getUser()]);

        return $this->render("main/profil.html.twig", [
            'commandes' => $commandes
        ]);
    }
}
