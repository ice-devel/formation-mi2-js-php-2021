<?php

namespace App\Tests\Entity;

use App\Entity\Topic;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TopicTest extends KernelTestCase
{
    public function testError(): void
    {
       $kernel = self::bootKernel();
       $validator = $kernel->getContainer()->get('validator');

       $topic = new Topic();
       $topic->setName("Tr");

       $violations = $validator->validate($topic);
       $this->assertCount(1, $violations);
    }

    public function testSuccess(): void
    {
       $kernel = self::bootKernel();
       $validator = $kernel->getContainer()->get('validator');

       $topic = new Topic();
       $topic->setName("Nom du topic");

       $violations = $validator->validate($topic);
       $this->assertCount(0, $violations);
    }
}
