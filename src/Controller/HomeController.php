<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Repository\CategoryRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {

        $categories = $this->getDoctrine()->getRepository( Category::class)->findAll();

        if (!$categories) {

            throw $this->createNotFoundException(

                'No categories found'
            );
        }


        return $this->render('Home/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{slug}", name="category")
     */
    public function category(string $slug,CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);
        
        return $this->render('Home/category.html.twig', [
            'category' => $category,
        ]);
    }
}


