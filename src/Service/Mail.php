<?php
namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class Mail {
    protected MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)    {
       $this->mailer = $mailer;
    }
    function envoie(  $exp_email,$sujet,$contenu){
      // ENVOIE DU MAIL
      $email = (new Email())
      ->from($exp_email)
      ->to('you@example.com')
      //->cc('cc@example.com')
      //->bcc('bcc@example.com')
      //->replyTo('fabien@example.com')
      //->priority(Email::PRIORITY_HIGH)
      ->subject($sujet)
      ->text($contenu)
      ->html($contenu); 

      $this->mailer->send($email);
 
    }
}