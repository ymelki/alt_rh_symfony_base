<?php

namespace App\Controller;

use App\Entity\Barticle;
use App\Form\Barticle1Type;
use App\Service\FileUploader;
use App\Repository\BarticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/barticle')]
class AdminBarticleController extends AbstractController
{
    #[Route('/', name: 'app_admin_barticle_index', methods: ['GET'])]
    public function index(BarticleRepository $barticleRepository): Response
    {
        return $this->render('admin_barticle/index.html.twig', [
            'barticles' => $barticleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_barticle_new', methods: ['GET', 'POST'])]
    public function new(FileUploader $fileUploader, Request $request, BarticleRepository $barticleRepository): Response
    {
        $barticle = new Barticle();
        $form = $this->createForm(Barticle1Type::class, $barticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            // 1 On recupére les infos du form correspondant à l'image
            $img = $form->get('image')->getData();
            
            // si l'image est bien présente dans le form et envoyé
            if ($img) {
                // 1 j'utilise le service pour envouyé l'image sur le serveur
                $FileName = $fileUploader->upload($img);
                // 2. je récupére le nom et le set dans l'entité
                $barticle->setFilenameimage($FileName);
            }
            
            $barticleRepository->save($barticle, true);

            return $this->redirectToRoute('app_admin_barticle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_barticle/new.html.twig', [
            'barticle' => $barticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_barticle_show', methods: ['GET'])]
    public function show(Barticle $barticle): Response
    {
        return $this->render('admin_barticle/show.html.twig', [
            'barticle' => $barticle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_barticle_edit', methods: ['GET', 'POST'])]
    public function edit(FileUploader $fileUploader,Request $request, Barticle $barticle, BarticleRepository $barticleRepository): Response
    {
        $form = $this->createForm(Barticle1Type::class, $barticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 1 On recupére les infos du form correspondant à l'image
            $img = $form->get('image')->getData();
            
            // si l'image est bien présente dans le form et envoyé
            if ($img) {
                // 1 j'utilise le service pour envouyé l'image sur le serveur
                $FileName = $fileUploader->upload($img);
                // 2. je récupére le nom et le set dans l'entité
                $barticle->setFilenameimage($FileName);
            } 
            $barticleRepository->save($barticle, true);

            return $this->redirectToRoute('app_admin_barticle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_barticle/edit.html.twig', [
            'barticle' => $barticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_barticle_delete', methods: ['POST'])]
    public function delete(Request $request, Barticle $barticle, BarticleRepository $barticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barticle->getId(), $request->request->get('_token'))) {
            $barticleRepository->remove($barticle, true);
        }

        return $this->redirectToRoute('app_admin_barticle_index', [], Response::HTTP_SEE_OTHER);
    }
}
