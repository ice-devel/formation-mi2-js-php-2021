<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeControllerTest extends WebTestCase
{
    /**
     * @dataProvider dataUrls
     */
    public function testAllPagesSuccess($url): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertResponseIsSuccessful();

        // tester un code précis
        //$this->assertResponseStatusCodeSame(503);
    }

    public function dataUrls() {
        return [
            ['/message/'],
            ['/app/list'],
        ];
    }
}
