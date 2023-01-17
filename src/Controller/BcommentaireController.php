<?php

namespace App\Controller;

use App\Entity\Bcommentaire;
use App\Form\Bcommentaire1Type;
use App\Repository\BcommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bcommentaire')]
class BcommentaireController extends AbstractController
{
    #[Route('/', name: 'app_bcommentaire_index', methods: ['GET'])]
    public function index(BcommentaireRepository $bcommentaireRepository): Response
    {
        return $this->render('bcommentaire/index.html.twig', [
            'bcommentaires' => $bcommentaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bcommentaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BcommentaireRepository $bcommentaireRepository): Response
    {
        $bcommentaire = new Bcommentaire();
        $form = $this->createForm(Bcommentaire1Type::class, $bcommentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bcommentaireRepository->save($bcommentaire, true);

            return $this->redirectToRoute('app_bcommentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bcommentaire/new.html.twig', [
            'bcommentaire' => $bcommentaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bcommentaire_show', methods: ['GET'])]
    public function show(Bcommentaire $bcommentaire): Response
    {
        return $this->render('bcommentaire/show.html.twig', [
            'bcommentaire' => $bcommentaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bcommentaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bcommentaire $bcommentaire, BcommentaireRepository $bcommentaireRepository): Response
    {
        $form = $this->createForm(Bcommentaire1Type::class, $bcommentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bcommentaireRepository->save($bcommentaire, true);

            return $this->redirectToRoute('app_bcommentaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bcommentaire/edit.html.twig', [
            'bcommentaire' => $bcommentaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bcommentaire_delete', methods: ['POST'])]
    public function delete(Request $request, Bcommentaire $bcommentaire, BcommentaireRepository $bcommentaireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bcommentaire->getId(), $request->request->get('_token'))) {
            $bcommentaireRepository->remove($bcommentaire, true);
        }

        return $this->redirectToRoute('app_bcommentaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
