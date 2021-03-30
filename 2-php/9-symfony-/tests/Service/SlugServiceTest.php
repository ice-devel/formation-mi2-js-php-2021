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

    /**
     * @dataProvider getSlugsData
     */
    public function testSlugSuccessWithDataProvider($original, $expected): void
    {
        // on va mocker le logger attendu par le slugservice
        $loggerMock = $this
            ->getMockBuilder(LoggerInterface::class)
            ->getMock();

        $slugger = new SlugService($loggerMock);
        $slug = $slugger->slug($original);

        $this->assertEquals($expected, $slug);
    }

    public function getSlugsData() {
        return [
            ["Bonjour je m'appelle", "bonjour-je-mappelle"],
            ["test de slug en cascade !", "test-de-slug-en-cascade"],
            ["test de slug en cascade ?", "test-de-slug-en-cascade"],
        ];
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

    public function testSlugWithMockTest(): void
    {
        /*
         * dummy
         */
        $loggerMock = $this->createMock(LoggerInterface::class);

        /*
         * stub : s'assurer qu'une méthode a été appelée
         */
        $loggerMock
            ->expects($this->once())
            ->method('info');

        /*
         * mock
         */
        /*
        $loggerMock
            ->expects($this->once())
            ->method('info')
            ->willReturn(??);
        */

        $slugger = new SlugService($loggerMock);

        $str = "Test de slug !";
        $slug = $slugger->slug($str, "_");

        //$this->assertEquals("test_de_slug", $slug);
    }

    public function testSlugException() {
        $loggerMock = $this->createMock(LoggerInterface::class);
        $slugger = new SlugService($loggerMock);

        $this->expectException(\Exception::class);
        // on vérifie que la fonction plante comme convenu si le separator n'est pas autorisé
        $slugger->slug("test de slug", "?");
    }
}
