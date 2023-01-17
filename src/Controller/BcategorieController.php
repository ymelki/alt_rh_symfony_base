<?php

namespace App\Controller;

use App\Entity\Bcategorie;
use App\Form\BcategorieType;
use App\Repository\BarticleRepository;
use App\Repository\BcategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bcategorie')]
class BcategorieController extends AbstractController
{
    #[Route('/', name: 'app_bcategorie_index', methods: ['GET'])]
    public function index(BcategorieRepository $bcategorieRepository): Response
    {
        return $this->render('bcategorie/index.html.twig', [
            'bcategories' => $bcategorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bcategorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BcategorieRepository $bcategorieRepository): Response
    {
        $bcategorie = new Bcategorie();
        $form = $this->createForm(BcategorieType::class, $bcategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bcategorieRepository->save($bcategorie, true);

            return $this->redirectToRoute('app_bcategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bcategorie/new.html.twig', [
            'bcategorie' => $bcategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bcategorie_show', methods: ['GET'])]
    public function show(Bcategorie $bcategorie): Response
    {
        return $this->render('bcategorie/show.html.twig', [
            'bcategorie' => $bcategorie,
        ]);
    }



    #[Route('/{id}/voir_article', name: 'voir_article', methods: ['GET', 'POST'])]
    public function voir_article(Request $request, Bcategorie $bcategorie, BcategorieRepository $bcategorieRepository, BarticleRepository $barticleRepository): Response
    { 
        // 1. bcategorie on a l'info sur la catégorie issue du param converter
        // 2. les barticles correspondant à cette catégorie
        $liste_article_cat=$barticleRepository->findBy(['bcategories' => $bcategorie->getId()]);
        // 3. renvoie la vue ! 
        return $this->render('bcategorie/article_categorie.html.twig', [
            'bcategorie' => $bcategorie,
            'liste_article'=>$liste_article_cat
        ]);
    }



    #[Route('/{id}/edit', name: 'app_bcategorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bcategorie $bcategorie, BcategorieRepository $bcategorieRepository): Response
    {
        $form = $this->createForm(BcategorieType::class, $bcategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bcategorieRepository->save($bcategorie, true);

            return $this->redirectToRoute('app_bcategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bcategorie/edit.html.twig', [
            'bcategorie' => $bcategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bcategorie_delete', methods: ['POST'])]
    public function delete(Request $request, Bcategorie $bcategorie, BcategorieRepository $bcategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bcategorie->getId(), $request->request->get('_token'))) {
            $bcategorieRepository->remove($bcategorie, true);
        }

        return $this->redirectToRoute('app_bcategorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
