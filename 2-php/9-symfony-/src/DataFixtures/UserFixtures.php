<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail("email$i@mail.fr");
            $user->setRoles(["ROLE_ADMIN"]);
            $user->setPassword("123");
            $manager->persist($user);
        }

        $manager->flush();
    }
}
