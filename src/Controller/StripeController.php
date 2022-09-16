<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Classes\Cart;
use App\Entity\Order;
use App\Entity\Product;
use Stripe\Checkout\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController



    
{



    #[Route('/commande/create_session/{reference}', name: 'stripe_create_session')]
    public function index(EntityManagerInterface $entityManager ,Cart $cart,$reference): response
    {
        $order = $entityManager->getRepository(Order::class)->findOneByReference($reference);

        if(!$order){
            new JsonResponse(['error' =>'order']);
        }

        

        $products_for_stripe = [];
        $YOUR_DOMAIN = 'http://127.0.0.1:8000';
        
  

        foreach($cart->getFull() as $product){
            // $product_object = $entityManager->getRepository(Product::class)->findOneByName($product->getProduct());
            $products_for_stripe[]= [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' =>$product['product']->getPrice(),
                    'product_data' => [
                      'name' => $product['product']->getName(),
                      'images' => [ $YOUR_DOMAIN."/uploads/images/".$product['product']->getIllustration()],
                    ],
                  ],
                  'quantity' => $product['quantity'],
                ];

        }

        Stripe::setApiKey('sk_test_51LTPbnAT8Dus2MRpuaExWEjd0YKhhwVwdBxTws3k6yIRbYMKKl0OqFNAx6Oj1NKQCFuo7syHFBFsRukdifO2bM4A0095wbl5nh');

        header('Content-Type: application/json');

        $checkout_session = Session::create([
        'customer_email' => $this->getUser()->getEmail(),
        'payment_method_types' => ['card'],
        'line_items' => [[
            $products_for_stripe
          ]],
            # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
            // 'price' => '{{PRICE_ID}}',
            // 
            'shipping_address_collection'=> [
              'allowed_countries'=> ['FR'],
            ],
     
            'shipping_options'=>[
              [
                'shipping_rate_data'=> [
                  'type'=> 'fixed_amount',
                  'fixed_amount'=> [
                    'amount'=> 1490 ,
                    'currency'=> 'eur',
                ],
                  'display_name'=> 'Collisimo',
                  'delivery_estimate'=> [
                    'minimum'=> [
                      'unit'=> 'business_day',
                      'value'=> 5,
                    ],
                    'maximum'=> [
                      'unit' => 'business_day',
                      'value'=> 7,
                    ],
                  ]
                ]
              ],
                  
            

         
              [
                'shipping_rate_data'=> [
                  'type'=> 'fixed_amount',
                  'fixed_amount'=> [
                    'amount'=>  990,
                    'currency'=> 'eur',
                ],
                  'display_name'=> 'Chronopost',
                  'delivery_estimate'=> [
                    'minimum'=> [
                      'unit'=> 'business_day',
                      'value'=> 5,
                    ],
                    'maximum'=> [
                      'unit' => 'business_day',
                      'value'=> 7,
                    ],
                  ]
                ]
              ],
            ],       
            
        
      

        'mode' => 'payment',
        
        'success_url' => $YOUR_DOMAIN.'/commande/merci/{CHECKOUT_SESSION_ID}',
        'cancel_url' => $YOUR_DOMAIN.'/commande/erreur/{CHECKOUT_SESSION_ID}',
        ]);

         
        $order->setStripeSessionId($checkout_session->id);
        $entityManager->flush();
      
        return $this->redirect($checkout_session->url);
      

    }
}
