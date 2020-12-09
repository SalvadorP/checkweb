<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky", name="lucky")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LuckyController.php',
        ]);
    }

    /**
     * @Route("/lucky/number/{max}", name="app_lucky_number")
     */
    public function number(int $max) : Response
    {
        $number = random_int(0, $max);
        return new Response('<html><body>'.$number.'</body></html>');
    }

    /**
     * @Route("/lucky/email", name="app_lucky_mail")
     */
    public function sendEmail(MailerInterface $mailer) : Response
    {
        // TODO: Using mailtrap, configure a proper mailer.
        $email = (new Email())
            ->from('test@localhost.com')
            ->to('myemail@localhost.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        return new Response('<html><body>Mail sent.</body></html>');
    }
}
