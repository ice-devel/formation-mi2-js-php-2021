<?php
/*
 * SOLID
 * - Single responsibility principle
 * - Open-closed principle
 * - Liskov substitution principle
 * - Interface segregation principle
 * - Dependency Inversion principle
 */
/*
 * S
 */
class Topic {
    private $name;

    public function insert() {

    }
}

/*
 * Pas single responsibility
 * Du coup :
 */
class Topic2 {

}
class TopicManager {

}

/*
 * Open-closed
 */
class Shipping {
    public $type;

    public function getPrice() {
        if ($this->type == "postal") {
            return 10;
        }
        elseif ($this->type == "plane") {
            $km = 2000;
            if ($km < 2000) {
                return 50;
            }
            elseif ($km < 5000) {
                return 100;
            }
            else {
                return 200;
            }
        }
        elseif ($this->type == "boat") {
            $km = 2000;
            if ($km < 2000) {
                return 75;
            }
            elseif ($km < 5000) {
                return 150;
            }
            else {
                return 300;
            }
        }
        elseif(false) {

        }
        elseif(false) {

        }
    }

    public function getDelay() {
    }
}

$shipping = new Shipping();
$shipping->type = "postal";
$shipping->getPrice();

/*
 * Remplaçons par ça
 */
interface ShippingInterface {
    public function getPrice();
    public function getDelay();
}
class PostalShipping implements ShippingInterface {
    public function getPrice() {
        return 50;
    }
    public function getDelay() {
        return 2;
    }
}
class PlaneShipping implements ShippingInterface  {
    public function getPrice() {
        $km = 2000;
        if ($km < 2000) {
            return 50;
        }
        elseif ($km < 5000) {
            return 100;
        }
        else {
            return 200;
        }
    }
    public function getDelay() {

    }
    public function getOtherThing() {

    }
}
class BoatShipping implements ShippingInterface {
    public function getPrice() {

    }
    public function getDelay() {

    }
}

$shipping = new PostalShipping();
calculerLePrix($shipping);


function calculerLePrix(ShippingInterface $shipping) {
    $shipping->getPrice();
}

/*
 * Liskov
 * On doit pouvoir une class mère par n'importe laquelle de ses classe filles
 */
abstract class Shipping2 {
    abstract public function getPrice(Order $order);
}

class OrderParent {

    private $products;
    private $totalPrice;
    public function getMethodParent() {}
}
class Order extends OrderParent {
}

class OrderVisitor extends Order {
    public $message;
}

class PostalShipping2 extends Shipping2 {
    public function getPrice(OrderParent $order) {
      if ($order->getMethodParent()) {

      }
    }
}

$orderVisitor = new OrderVisitor();
$postalShipping = new PostalShipping2();
$price = $postalShipping->getPrice($orderVisitor);



/*
 * Interface segregation
 */
interface Human {
    public function run();
    public function eat();
}

/*
 * Découper les responsibilités dans les interfaces
 */
interface Run {
    public function run();
}
interface Eat {
    public function eat();
}
/*
 * Dependency Inversion principle
 *
 */

class MessageManager {
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}

interface DatabaseInterface {
    public function query():bool;
}

class Message2Manager {
    private $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }
}