<?php

namespace App\Controller;

use App\Services\MessageGenerator;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    public function __construct(LoggerInterface $logger)
    {
//        $logger->info('checking');
//        throw $this->createNotFoundException('Hmm, looks like you are lost in the OZ');
    }

    /**
     * @throws Exception
     *
     * @Route("/lucky/number")
     */
    public function number(Request $request, LoggerInterface $logger, MessageGenerator $messageGenerator): Response
    {
        dd($messageGenerator->getHappyMessage());
        $number = random_int(0, 100);

        /*return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );*/

        $data = [
            'number' => $number
        ];
        return $this->render('lucky/number.html.twig', $data);
    }
}
