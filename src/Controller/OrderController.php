<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Entity\Order;
use App\Form\OrderType;
use App\Entity\OrderDetails;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTimeinterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('/commande', name:'order')]
    public function index(Cart $cart, Request $request): Response
    {
    if(!$this->getUser()->getAddresses()->getValues()){
        return $this->redirectToRoute('account_address_add');
    }

        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

         
        return $this->render('order/index.html.twig',[
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }


    #[Route('/commande/recapitulatif', name:'order_recap', methods:('POST') )]
    public function add(Cart $cart, Request $request): Response
    {


        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()
        ]);

            $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid()){
            $date = new \DateTime();
            $carriers =  $form->get('carrier')->getData();
            $delivery = $form->get('addresses')->getData();
            $delivery_content = $delivery->getFirstname().' '.$delivery->getLastname();
            $delivery_content .= '<br/>'.$delivery->getphone();

            if($delivery->getCompany()){
                $delivery_content .= '<br/>'.$delivery->getCompany();
            }
            $delivery_content .= '<br/>'.$delivery->getAdress();
            $delivery_content .= '<br/>'.$delivery->getPostal().' '.$delivery->getCity();
            $delivery_content .= '<br/>'.$delivery->getCountry();

            
            
                $order = new Order();
                $order->setUser($this->getUser());
                $reference = $date->format('dmY').'-'.uniqid();
                $order->setReference($reference);
                $order->setCreatedAt($date);
                $order->setCarrierName($carriers->getName());
                $order->setCarrierPrice($carriers->getPrice());
                $order->setDelivery($delivery_content);
                $order->setState(0);

                $this->entityManager->persist($order);

                

                
                foreach($cart->getFull() as $product){
                    
                    $order_details = new OrderDetails();
                    $order_details->setMyOrder($order);
                    $order_details->setProduct($product['product']->getName());
                    $order_details->setQuantity($product['quantity']);
                    $order_details->setPrice($product['product']->getprice());
                    $order_details->setTotal($product['product']->getprice() * $product['quantity']);
                    $this->entityManager->persist($order_details);

                    
                        }
                       
                      
                $this->entityManager->flush();

               

               

                return $this->render('order/add.html.twig',[
                    'delivery' => $delivery_content,
                    'cart' => $cart->getFull(),
                    'carrier' => $carriers,
                    'reference' => $order->getReference()
                ]);
        }

        return $this->redirectToRoute('cart');        
    }
}
