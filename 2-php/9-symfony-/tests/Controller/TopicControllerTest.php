<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TopicControllerTest extends WebTestCase
{
    public function testRedirectIfNotLogged(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/topic/');

        $this->assertResponseRedirects("/admin/login");
    }

    public function testNew(): void
    {
        $client = static::createClient();

        /*
        $user = new User();
        $user->setEmail("admin@test.fr");
        $user->setPassword("123");
        $user->setRoles(["ROLE_ADMIN"]);
        */

        //$client->loginUser(?);
        $crawler = $client->request('GET', '/admin/topic/new');


        $this->assertResponseIsSuccessful();
    }


}
