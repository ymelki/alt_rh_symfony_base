<?php

namespace App\Controller;

use App\Repository\BarticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index( Request $request,
    BarticleRepository $barticleRepository   ): Response
    { 
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'barticles' => $barticleRepository->findAll()
        ]);
    }
}
