<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessageControllerTest extends WebTestCase
{
    public function testMessageH1(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/message/');

        $this->assertSelectorTextContains('h1', 'Message index');
        $this->assertSelectorTextContains('h2', 'Mon H2');
    }
}
