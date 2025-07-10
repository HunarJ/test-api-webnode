<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderApiTest extends WebTestCase
{
    public function testGetOrderDetail(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orders/1');

        $this->assertResponseIsSuccessful();
        $this->assertResponseFormatSame('json');

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('id', $data);
        $this->assertEquals(1, $data['id']);
        $this->assertArrayHasKey('items', $data);
        $this->assertIsArray($data['items']);
    }
}
