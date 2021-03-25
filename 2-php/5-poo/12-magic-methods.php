<?php
/*
 * Les méthodes magiques
 * Ces méthodes sont des fonctions qui sont exécutées automatiquement par
 * PHP lors de certaines actions sur des objets
 */

class Dog {
    public $name = "doggy";
}

class Human {
    public $name = "Jacky";
    public $dog;
    private $email;

    public function __construct(){}
    public function __destruct(){ echo "Mort<br>";}
    public function __toString(): string
    {
        return $this->name;
    }
    public function __clone() {
        echo "clonage en cours<br>";
        // this c'est le nouvel objet : le clone (human2)
        // on clone le chien de humain1 pour en avoir un nouveau
        $this->dog = clone $this->dog;
    }

    public function __get($name) {
        var_dump($name);
    }

    public function __set($name, $value) {
        var_dump($name);
        var_dump($value);
    }

    public function __call($method, $parameters) {
        var_dump($method);
        var_dump($parameters);
    }

    /*
     * __serialize
     * __unserialize
     *
        $chaine = serialize($human);
        $human = unserialize($chaine);
     */

    /*
     * __invoke ?
     */
    public function __invoke($param) {
        var_dump($param);
    }


}

$human = new Human(); // __construct
$human->dog = new Dog();
echo $human."<br>";

$human2 = clone $human; // __clone

echo "<pre>";
$human->dog->name = "the dog";
var_dump($human);
var_dump($human2);

$property = rand(45, 155);

echo $human->$property; // __get déclenché car propriété inexistante ou pas visible
$human->age = 30; // __set déclenché car propriété inexistante ou pas visible

$human->marqueUnBut("toto", 2); // __call déclenché

$human(45); // __invoke déclenché
is_callable($human); // true