<?php
/*
 * Héritage / inheritance
 * Une classe qui hérite d'une autre classe possède les propriétés et les méthodes de la classe parent
 * Classe A : parent
 * Classe B hérite de A : enfant : B possède les propriétés et les méthodes de A
 *
 * On utilise l'héritage quand plusieurs classes ont des propriétés ou des comportements en commun,
 * mais qu'elles ont chacune des spécificités
 *
 * Dans l'héritage, si B hérite de A, on peut donc dire que B est un A, mais pas l'inverse
 */

class Commercial extends User {
    private array $products = ['banane', 'bureau'];
    // cette classe hérite de User, donc elle a un name,username,password..
    // ainsi que les méthodes __construct, sayHello...
    // mais il est spécialisé : ici il a des products que le user n'a pas
    public function lookAtMyProducts() {
        echo "Mes produits : (Call me ".$this->getName().")";
        foreach ($this->products as $product) {
            echo "<p>".$product."</p>";
        }
    }

}

class Client extends User {
    private array $orders;
    private string $email;

    public function __construct($name, $email)
    {
        parent::__construct($name);
        $this->email = $email;
    }

    /*
     * Surcharge / Override : on rédéfinit une méthode existant dans le parent
     *
     * Modifier la visibilité : on ne peut pas rendre la visibilité plus restrictive
     * mais on peut la changer pour quelque-chose de plus permissif
     */
    public function thinkAboutSomething($something) {
        echo "I'M THINKING OF ".mb_strtoupper($something);
    }
}

class Admin extends User {
    private array $roles;

    /*
     * Surcharge / Override : on rédéfinit une méthode existant dans le parent
     *
     * Modifier la visibilité : on ne peut pas rendre la visibilité plus restrictive
     * mais on peut la changer pour quelque-chose de plus permissif
     */
    // impossible : private function sayHello()
    public function sayHello()
    {
        // on peut exécuter ce qui se trouvait dans la classe parent
        // parent::sayHello();

        // ou alors on peut redéfinir totalement le comportement
        echo "<p>Hey salut gros moi C ".$this->name."</p>";
    }
}

class User {
    /*
     * Nouvelle visibilité : protected = accessible directement
     * dans les classes enfant sans passer par les getter/setter
     *
     */
    protected string $name;
    private string $username;
    private string $password;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function sayHello() {
        echo "<p>Bonjour my name est ".$this->name."</p>";
    }

    public function getName() {
        return $this->name;
    }

    private function thinkAboutSomething($something) {
        echo "(I'm thinking of $something)";
    }
}

$commercial = new Commercial("toto");
$commercial->sayHello();
$commercial->lookAtMyProducts();

echo "<pre>";
var_dump($commercial);

$admin = new Admin("jean l'admin");
$admin->sayHello();

echo "<br>";

$client = new Client('momo', 'momo@gmail.com');
$client->thinkAboutSomething("I would like to buy this for nothing please");
var_dump($client);

$users = [$commercial, $admin, $client];

foreach ($users as $user) {
    // pas besoin de connaitre la spécialisation pour utiliser les comportements commun :
    /** @var User $user */
    $user->sayHello();

    // tester une spécialisation : tester si un objet est une instance d'une certaine classe
    if ($user instanceof Commercial) {
        $user->lookAtMyProducts();
    }
}

// les enfants sont des parents
if ($admin instanceof User) {
    // on rentre
}
if ($commercial instanceof User) {
    // on rentre
}
if ($client instanceof User) {
    // on rentre
}