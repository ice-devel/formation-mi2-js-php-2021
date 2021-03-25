<?php
namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\String\AbstractUnicodeString;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\String\UnicodeString;

class SlugService implements SluggerInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

   public function slug(string $text, string $separator = '-', string $locale = null): AbstractUnicodeString {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return new UnicodeString("n-a");
        }

        $this->addLog($text);
        return new UnicodeString($text);
    }

    public function addLog($text) {
        $this->logger->info("On a slugify : $text");
    }
}