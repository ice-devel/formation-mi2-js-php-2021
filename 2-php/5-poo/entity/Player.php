<?php

class Player {
    /*
     * Propriété de classe
     */
    private $id;
    private ?DateTime $createdAt;
    private $name;
    private $score;
    private $zipcode;
    private $isEnabled;
    private $teamId;

    // constante de classe
    const EXPERIENCE = 15;

    // propriété statique
    static public $multiply = 3;
    static private $nbPlayers = 0;

    /*
     * Le constructeur est déclenchée lors de l'instanciation
     */
    /**
     * Player constructor.
     * @param $id
     * @param DateTime $createdAt
     * @param $name
     * @param $zipcode
     * @param $isEnabled
     * @param $teamId
     */
    public function __construct($id=null, ?DateTime $createdAt=null, $name=null,
                                $zipcode=null, $isEnabled=null, $teamId=null)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->name = $name;
        $this->zipcode = $zipcode;
        $this->isEnabled = $isEnabled;
        $this->teamId = $teamId;
        $this->setDefaultScore();
        self::addOnePlayer();
    }

    /*
     * Getter / setter
     * accesseur / mutateur
     * Principe d'encapsulation, forcer l'accès et la modification des valeurs
     * à un seul endroit
     */
    /*
     * getter
     */
    public function getName() {
        return $this->name;
    }

    /*
     * setter
     */
    public function setName($name) {
        $name = mb_strtoupper($name);
        $this->name = $name;
    }

    /*
     * getter
     */
    public function getZipcode() {
        if (strlen($this->zipcode) == 4) {
            $this->zipcode = "0".$this->zipcode;
        }
        return $this->zipcode;
    }

    public function setScore(int $score) {
        /*
        if (!is_int($score)) {
            throw new Exception("Le score c'est un entier");
        }
        */
        $this->score = $score;
    }

    public function setDefaultScore() {
        $this->score = rand(10, 15);
    }

    /*
     * setter
     */
    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
    }


    public function hit(Player $hitPlayer) {
       // $this->score += Player::EXPERIENCE;
        // this : reference à une instance
        // self référence à la classe elle-même
        $this->score += self::EXPERIENCE;
        $hitPlayer->score -= 10;
        echo $this->name." frappe ".$hitPlayer->name;
    }

    static public function addOnePlayer() {
        self::$nbPlayers++;
        // $this->
        // le this n'a pas de sens dans une méthode statique
        // car c'est une classe qui appelle cette méthode
        // et non pas une instance
    }

    static public function getNbPlayers() {
        return self::$nbPlayers;
    }
}

$player = new Player("test");
$player = new Player("test");
$player = new Player("test");
$player = new Player("test");

//$player->setName("test");

$player->setName("test2");
echo $player->getZipcode();
$player->setScore("23");


