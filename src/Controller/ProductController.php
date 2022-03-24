<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ValidatorInterface $validator, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $product = new Product();
        $product->setName(null);
        $product->setPrice('23');
        $product->setDescription('Notheing special');

        $errors = $validator->validate($product);

        if (count($errors)){
            return new Response("Error: {$errors}", 400);
        }

        $entityManager->persist($product);
        $entityManager->flush();

        return new JsonResponse("Product created {$product->getId()}");

        /*return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);*/
    }
}
