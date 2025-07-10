<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $order = new Order();
            $order->setName('Objednávka ' . $i);
            $order->setAmount(mt_rand(100, 1000));
            $order->setCurrency('CZK');
            $order->setStatus('new');
            $order->setCreatedAt(new \DateTimeImmutable());

            for ($j = 1; $j <= 3; $j++) {
                $item = new OrderItem();
                $item->setName('Položka ' . $j . ' objednávky ' . $i);
                $item->setAmount(mt_rand(10, 100));
                $item->setOrder($order);
                $order->addItem($item);
                $manager->persist($item);
            }

            $manager->persist($order);
        }

        $manager->flush();
    }
}
