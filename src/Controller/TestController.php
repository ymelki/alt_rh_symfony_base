<?php

namespace App\Controller;

use App\Service\Afficher_bonjour;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(Envoiedemail $Envoiedemail,
        
         MailerInterface $mailer): Response
    { 
        $Envoiedemail->envoie($expediteur,$sujet,$contenu);
        
        //   Classes (service) < Fonction (procedural lié à des données dans des objets)

        $email = (new Email())
        ->from('hello@example.com')
        ->to('you@example.com')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Time for Symfony Mailer!')
        ->text('Sending emails is fun again!')
        ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
