<?php


namespace App\Service;


class RandomQuote
{
    public function getDailyQuote() {
        $quotes = ["L'informatique c'est bien", "Le PHP c'est bien"];
        $random = rand(0, 1);
        $dayQuote = $quotes[$random];

        return $dayQuote;
    }
}