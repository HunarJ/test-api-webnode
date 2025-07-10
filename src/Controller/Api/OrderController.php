<?php

namespace App\Controller\Api;

use App\Application\Order\OrderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }


    #[Route('/api/orders/{id}', name: 'api_order_detail', methods: ['GET'])]
    public function detail(int $id): JsonResponse
    {
        $order = $this->orderService->getOrderById($id);

        if (!$order) {
            return $this->json(['error' => 'Order not found'], 404);
        }

        return $this->json([
            'id' => $order->getId(),
            'name' => $order->getName(),
            'amount' => $order->getAmount(),
            'currency' => $order->getCurrency(),
            'status' => $order->getStatus(),
            'createdAt' => $order->getCreatedAt()?->format('Y-m-d H:i:s'),
            'items' => array_map(function ($item) {
                return [
                    'name' => $item->getName(),
                    'amount' => $item->getAmount(),
                ];
            }, $order->getItems()),
        ]);
    }
}
