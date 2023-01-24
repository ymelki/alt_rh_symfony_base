<?php

namespace App\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestFileController extends AbstractController
{
    #[Route('/test/file', name: 'app_test_file')]
    public function index(  Filesystem $filesystem   ): Response
    {
        $filesystem->mkdir('Didier/', 0700);
        return $this->render('test_file/index.html.twig', [
            'controller_name' => 'TestFileController',
        ]);
    }
}
