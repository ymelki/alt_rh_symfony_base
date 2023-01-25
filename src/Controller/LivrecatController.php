<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivrecatController extends AbstractController
{
    #[Route('/livrecat/{id}', name: 'app_livrecat')]
    public function index(Categorie $categorie, LivreRepository $livres): Response
    {
        $leslivres=$livres->findBy([ "categories" =>$categorie ]);
        dd($leslivres);
        return $this->render('livrecat/index.html.twig', [
            'controller_name' => 'LivrecatController',
        ]);
    }
}
