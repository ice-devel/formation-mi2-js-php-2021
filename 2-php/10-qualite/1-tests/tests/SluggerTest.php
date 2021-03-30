<?php

require __DIR__.'/../src/Slugger.php';

class SluggerTest extends \PHPUnit\Framework\TestCase
{
    public function testSlugSuccess() {
        $slugger = new Slugger();

        $str = "Bonjour ! comment ça va ?";
        $slug = $slugger->slug($str);

        $expectedSlug = "bonjour-comment-ca-va";

        $this->assertEquals($expectedSlug, $slug);
    }

    public function testSlugError() {
        $slugger = new Slugger();

        $str = "Bonjour ! comment ça va ?";
        $slug = $slugger->slug($str);

        $expectedSlug = "Bonjour-comment-ca-va";

        $this->assert($expectedSlug, $slug);
    }
}