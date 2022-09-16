<?php

namespace App\Controller;

use App\Classes\Filter;
use App\Entity\Product;
use App\Entity\Category;
use App\Form\FilterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct( EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/nos-produits', name: 'products')]
    public function index( request $request): Response
    {
       
        $categories = $this->entityManager->getRepository(Category::class)->findAll();
        $filters = new Filter();
        $form = $this->createForm(FilterType::class, $filters);
        
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findFromFilter($filters);
            
        }
        else {
            $products = $this->entityManager->getRepository(Product::class)->findAll();
        }


        return $this->render('product/index.html.twig',[
            'products' => $products,
            'categories' => $categories,
            'form' => $form->createView()
        ]);
    }

    #[Route('/produit/{slug}', name: 'product')]
    public function show($slug): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);
        if (!$product){
            return $this->redirectToRoute('products');
        }

        return $this->render('product/show.html.twig',[
            'product' => $product ,
            'products' =>$products
        ]);
    }


    #[Route('/search_product', name:'search_products')]
    public function search( request $request): Response
    {
        $categories = $this->entityManager->getRepository(Category::class)->findAll();

        $filter=[];
        if( array_key_exists('categories', $_GET)){
        $filter['categories'] = $_GET['categories'];
        }
        if( array_key_exists('search', $_GET)){
        $filter['search']=$_GET['search'];
        }
        
        
      
            $products = $this->entityManager->getRepository(Product::class)->findFromFilter($filter);
            // $products = $this->entityManager->getRepository(Product::class)->findAll();
        
        

        return $this->render('product/index.html.twig',[
            'products' => $products,
            'categories' => $categories
            
        ]);
    }


}
