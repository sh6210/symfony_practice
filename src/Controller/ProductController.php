<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController implements LoggerAwareInterface
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/product', name: 'app_product')]
    public function index(ValidatorInterface $validator, ManagerRegistry $doctrine, MailerInterface $mailer): Response
    {
        try{
            $email = new Email();
            $email->from('hello@example.com')
                  ->to('shcseilacs@gmail.com')
                  ->subject('checking symfony sample email')
                  ->text('mail body')
                  ->html('<h2>checking as html</h2>');

            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            dd($e);
        }


        return new Response('done');

        /*$entityManager = $doctrine->getManager();
        $product = new Product();
        $product->setName('prod 001');
        $product->setPrice('23');
        $product->setDescription('Notheing special');

        $errors = $validator->validate($product);

        if (count($errors)){
            return new Response("Error: {$errors}", 400);
        }

        $entityManager->persist($product);
        $entityManager->flush();

        return new JsonResponse("Product created {$product->getId()}");*/

        /*return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);*/
    }

    public function setLogger(LoggerInterface $logger): void
    {
        /*$logger->info("this is info");
        $logger->alert("this is alert");
        $logger->critical("this is critical");
        $logger->debug("this is debug");
        $logger->emergency("this is emergency");
        $logger->error("this is error");
        $logger->notice("this is notice");
        $logger->warning("this is warning");*/
    }
}
