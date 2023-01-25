<?php

namespace App\Controller;

use App\Entity\Mcommande;
use App\Form\McommandeType;
use App\Repository\McommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mcommande')]
class McommandeController extends AbstractController
{
    #[Route('/', name: 'app_mcommande_index', methods: ['GET'])]
    public function index(McommandeRepository $mcommandeRepository): Response
    {
     //   dd($mcommandeRepository->findAll());
        return $this->render('mcommande/index.html.twig', [
            'mcommandes' => $mcommandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mcommande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, McommandeRepository $mcommandeRepository): Response
    {
        $mcommande = new Mcommande();
        $form = $this->createForm(McommandeType::class, $mcommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mcommandeRepository->save($mcommande, true);

            return $this->redirectToRoute('app_mcommande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mcommande/new.html.twig', [
            'mcommande' => $mcommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mcommande_show', methods: ['GET'])]
    public function show(Mcommande $mcommande): Response
    {
        return $this->render('mcommande/show.html.twig', [
            'mcommande' => $mcommande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mcommande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mcommande $mcommande, McommandeRepository $mcommandeRepository): Response
    {
        $form = $this->createForm(McommandeType::class, $mcommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mcommandeRepository->save($mcommande, true);

            return $this->redirectToRoute('app_mcommande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mcommande/edit.html.twig', [
            'mcommande' => $mcommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mcommande_delete', methods: ['POST'])]
    public function delete(Request $request, Mcommande $mcommande, McommandeRepository $mcommandeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mcommande->getId(), $request->request->get('_token'))) {
            $mcommandeRepository->remove($mcommande, true);
        }

        return $this->redirectToRoute('app_mcommande_index', [], Response::HTTP_SEE_OTHER);
    }
}
