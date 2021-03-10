<?php

class Player {
    public string $name;
    public $points;
    public $zipcode;
    public $isEnabled;

    public function hit(Player $hitPlayer) {
        $this->points += 10;
        $hitPlayer->points -= 10;
        echo $this->name." frappe ".$hitPlayer->name;
    }
}