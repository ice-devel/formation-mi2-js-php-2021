<?php
/*
 * Trait :
 * Des fonctionnalités qu'on réutiliser dans des classes qui n'ont aucun rapport
 * entre elles, du moment que la fonctionnalité est exactement la même pour chacun
 */

trait Polite {
    // dans un trait on écrit la signature ainsi que le corps,
    // cette méthode sera exécutée telle quelle dans les classes qui utilise "use" ce trait
    public function sayHello() {
        echo "Hello!";
    }
}

class Salary {
    use Polite;
}

class Developer extends Salary {

}

class Designer extends Salary {
}

class CEO {
}

class Chief {
    use Polite;
}

$salary = new Salary();
$salary->sayHello();
$chief = new Chief();
$chief->sayHello();