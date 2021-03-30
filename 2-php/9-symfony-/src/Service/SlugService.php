<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
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
       if ($separator == "?") {
           throw new \Exception();
       }

        $oldLocale = setlocale(LC_ALL, '0');
       setlocale(LC_ALL, 'en_US.UTF-8');
       $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
       $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
       $clean = strtolower($clean);
       $clean = preg_replace("/[\/_|+ -]+/", $separator, $clean);
       $clean = trim($clean, $separator);
       setlocale(LC_ALL, $oldLocale);

       //$this->addLog($text);
       $this->logger->info("On a slugify : $text");

       return new UnicodeString($clean);
    }

    public function addLog($text) {
        $this->logger->info("On a slugify : $text");
    }
}