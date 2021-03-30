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

    public function testNew200(): void
    {
        $client = static::createClient();

        $container = $client->getContainer();
        $em = $container->get('doctrine')->getManager();
        $user = $em->getRepository(User::class)->find(1);

        $client->loginUser($user);
        $crawler = $client->request('GET', '/admin/topic/new');

        $this->assertResponseIsSuccessful();
    }

    public function testNewForm(): void
    {
        $client = static::createClient();

        $container = $client->getContainer();
        $em = $container->get('doctrine')->getManager();
        $user = $em->getRepository(User::class)->find(1);

        $client->loginUser($user);
        $crawler = $client->request('GET', '/admin/topic/new');
        $this->assertResponseIsSuccessful();
        /*
        $form = $crawler->selectButton("Enregistrer")->form([
            'topic[name]' => 'Topic créé par test'
        ]);
        $client->submit($form);
        */

        // est-ce que le formulaire est ok ?
        /*
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorExists(".alert.alert-success");
        */

        // est-ce que le formulaire a planté ?
        // $this->assertSelectorExists(".alert.alert-danger");
    }


}
