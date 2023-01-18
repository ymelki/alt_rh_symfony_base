<?php

namespace App\Controller;

use App\Entity\Barticle;
use App\Form\BarticleType;
use App\Entity\Bcommentaire;
use App\Form\Bcommentaire1Type;
use App\Repository\BarticleRepository;
use App\Repository\BcommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/barticle')]
class BarticleController extends AbstractController
{
    #[Route('/', name: 'app_barticle_index', methods: ['GET'])]
    public function index(BarticleRepository $barticleRepository): Response
    {
        return $this->render('barticle/index.html.twig', [
            'barticles' => $barticleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_barticle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BarticleRepository $barticleRepository): Response
    {
        $barticle = new Barticle();
        $form = $this->createForm(BarticleType::class, $barticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barticleRepository->save($barticle, true);

            return $this->redirectToRoute('app_barticle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('barticle/new.html.twig', [
            'barticle' => $barticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barticle_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Barticle $barticle , BcommentaireRepository $bcommentaireRepository): Response
    {



        $bcommentaire = new Bcommentaire();
        $form = $this->createForm(Bcommentaire1Type::class, $bcommentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bcommentaireRepository->save($bcommentaire, true);

            return $this->redirectToRoute('app_barticle_show', ['id' => $barticle->getId()], Response::HTTP_SEE_OTHER);
        }

 

        // recuperer tout les commantaires correspondant à l'identifiant de l'URL
        $commentaire=$bcommentaireRepository->findBy(['barticles' => $barticle->getId()]);
        
        return $this->renderForm('barticle/show2.html.twig', [
            'barticle' => $barticle,
            'commentaire' => $commentaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_barticle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Barticle $barticle, BarticleRepository $barticleRepository): Response
    {
        $form = $this->createForm(BarticleType::class, $barticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barticleRepository->save($barticle, true);

            return $this->redirectToRoute('app_barticle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('barticle/edit.html.twig', [
            'barticle' => $barticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barticle_delete', methods: ['POST'])]
    public function delete(Request $request, Barticle $barticle, BarticleRepository $barticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barticle->getId(), $request->request->get('_token'))) {
            $barticleRepository->remove($barticle, true);
        }

        return $this->redirectToRoute('app_barticle_index', [], Response::HTTP_SEE_OTHER);
    }
}
