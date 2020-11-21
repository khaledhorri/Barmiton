<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Notification extends AbstractController
{

    private \Swift_Mailer $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notifyContact(Contact $contact)
    {

        $message = (new \Swift_Message('Test envoi de mail'))
            ->setFrom('sendExample@gmail.com')
            ->setTo($contact->getEmail())
            ->setBody(
                $this->render('contact/email.html.twig', [
                    'contact' => $contact
                ]),
                'text/html'
            );

        return $this->mailer->send($message);
    }
}
