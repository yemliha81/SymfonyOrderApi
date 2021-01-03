<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;
use App\Entity\Order;

class OrderController extends AbstractController
{
    /**
    * @Rest\Get(
    *     path = "/orders",
    *     name = "orders"
    * )
    */
    public function orders(Request $request)
    {
        $customerId = $this->getUser()->getUserId();
        $isAdmin = $this->getUser()->getAdmin();
        if($isAdmin){
            $orders = $this->getDoctrine()->getRepository('App\Entity\Order')
            ->findAll();
        }else{
            $orders = $this->getDoctrine()->getRepository('App\Entity\Order')
                ->findBy(array('customerId' => $customerId));
        }

        
        
        $arrayCollection = array();

        foreach($orders as $order) {
            $orderCollection[] = array(
                'id' => $order->getId(),
                'orderCode' => $order->getOrderCode(),
                'productId' => $order->getProductId(),
                'quantity' => $order->getQuantity(),
                'address' => $order->getAddress(),
                'shippingDate' => $order->getShippingDate()
            );
        }   

        $response = new Response(json_encode($orderCollection));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    /**
    * @Rest\Post(
    *     path = "/orders/create",
    *     name = "orders_create"
    * )
    */
    public function create(Request $request)
    {


        $content = json_decode($request->getContent(), true);

        $customerId = $this->getUser()->getUserId();
        $orderCode = uniqid();
        $productId = $content['productId'];
        $quantity = $content['quantity'];
        $address = $content['address'];
        $shippingDate =  $content['shippingDate'];

        $order = new Order();
        
        $order->setCustomerId($customerId);
        $order->setOrderCode($orderCode);
        $order->setProductId($productId);
        $order->setQuantity($quantity);
        $order->setAddress($address);
        $order->setShippingDate($shippingDate);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        return new Response("success");
    }

    /**
    * @Rest\Post(
    *     path = "/orders/find",
    *     name = "orders_find"
    * )
    */
    public function find(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $orderCode = $content['orderCode'];
        $userId = $this->getUser()->getUserId();
        $isAdmin = $this->getUser()->getAdmin();
        

        $order = $this->getDoctrine()->getRepository('App\Entity\Order')
            ->findOneBy(array('orderCode' => $orderCode));

        if(empty($order)){
            return new Response("Order not found");
        }else{

            if(!$isAdmin){
                if($userId != $order->getCustomerId()){
                    return new Response("You don't have access for this order!");
                }
            }

            $orderArray = array(
                'id' => $order->getId(),
                'customerId' => $order->getCustomerId(),
                'orderCode' => $order->getOrderCode(),
                'productId' => $order->getProductId(),
                'quantity' => $order->getQuantity(),
                'address' => $order->getAddress(),
                'shippingDate' => $order->getShippingDate()
            );
            
            $response = new Response(json_encode($orderArray));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }

       
    }

    /**
     * @Rest\Put(
     *     path = "/orders/edit",
     *     name = "orders_edit",
     *     requirements = {"OrderId"="\d+"}
     * )
     *
     */
    public function edit(Request $request)
    {  
        
        $content = json_decode($request->getContent(), true);
        $isAdmin = $this->getUser()->getAdmin();

        $order = $this->getDoctrine()->getRepository('App\Entity\Order')
        ->find($content['id']);
        
        if (null === $order) {
           return new Response("Specified order not found");
        }

        if( time() < strtotime($order->getShippingDate() ) ){
          
            $userId = $this->getUser()->getUserId();
            
            $productId = $content['productId'];
            $quantity = $content['quantity'];
            $address = $content['address'];
            $shippingDate =  $content['shippingDate'];

            $order->setProductId($productId);
            $order->setQuantity($quantity);
            $order->setAddress($address);
            $order->setShippingDate($shippingDate);

            if(!$isAdmin){
                if($userId != $order->getCustomerId()){
                    return new Response("You don't have access for this order!");
                }
            }
    
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();

          return new Response("Order Updated Successfully");
        }else{
          return new Response("Error, shipping date expired");
        }

            
        

    }
}