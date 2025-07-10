<?php

namespace App\Application\Order;

use App\Entity\Order;
use App\Entity\OrderItem;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createOrder(string $name, float $amount, string $currency, string $status, array $itemsData): Order
    {
        $order = new Order();
        $order->setName($name);
        $order->setAmount($amount);
        $order->setCurrency($currency);
        $order->setStatus($status);
        $order->setCreatedAt(new \DateTimeImmutable());

        // Přidání položek objednávky
        foreach ($itemsData as $itemData) {
            $item = new OrderItem();
            $item->setName($itemData['name']);
            $item->setAmount($itemData['amount']);
            $item->setOrder($order);  // Přiřazení položky k objednávce

            $order->addItem($item);
        }

        // Uložení objednávky a položek do databáze
        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return $order;
    }

    public function getOrderById(int $id): ?Order
    {
        return $this->entityManager->getRepository(Order::class)->find($id);
    }
}
