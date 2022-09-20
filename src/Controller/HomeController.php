<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Header;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;


class HomeController extends AbstractController
{


    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
       
        

     

        $categories = $this->entityManager->getRepository(Category::class)->findAll();
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        $products = $this->entityManager->getRepository(Product::class)->findAll();
       $bestProducts = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
       
        return $this->render('home/index.html.twig',[
            'products' => $products,
            'headers' => $headers,
            'categories' => $categories
        ]);

    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();
       $products = $this->entityManager->getRepository(Product::class)->findAll();
       $bestProducts = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
       
        return $this->render('home/about.html.twig');

    }


}
