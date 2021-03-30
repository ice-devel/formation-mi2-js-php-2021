<?php

namespace App\Tests\Service;

use App\Service\SlugService;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class SlugServiceTest extends TestCase
{
    public function testSlugSuccess(): void
    {
        // on va mocker le logger attendu par le slugservice
        $loggerMock = $this
            ->getMockBuilder(LoggerInterface::class)
            ->getMock();

        $slugger = new SlugService($loggerMock);

        $str = "Test de slug !";
        $slug = $slugger->slug($str);

        $this->assertEquals("test-de-slug", $slug);
    }

    public function testSlugDelimiterSuccess(): void
    {
        // on va mocker le logger attendu par le slugservice
        $loggerMock = $this
            ->getMockBuilder(LoggerInterface::class)
            ->getMock();

        $slugger = new SlugService($loggerMock);

        $str = "Test de slug !";
        $slug = $slugger->slug($str, "_");

        $this->assertEquals("test_de_slug", $slug);
    }
}
