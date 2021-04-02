<?php

namespace App\Tests\Entity;

use App\Entity\Trainee;
use PHPUnit\Framework\TestCase;

class TraineeTest extends TestCase
{
    public function testIsBirthday(): void
    {
        $trainee = new Trainee();
        $trainee->setBirthday(new \DateTime());
        $isBirthday = $trainee->isBirthday();

        $this->assertTrue($isBirthday);
    }
}
