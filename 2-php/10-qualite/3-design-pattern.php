<?php
/*
 * Les design pattern (patron de conception)
 * sont des solutions à des problèmes de
 * conception récurrents
 */

/*
 * Pattern créationnel : Factory, Singleton, Builder, Prototype
 * Pattern comportementaux : Stragegy, Observer, State, Iterator
 * Pattern structurels : Adapter, Decorator, Facade
 * Injection de dépendance
 */

interface Payment {}
class PaypalPayment implements Payment {}
class StripePayment implements Payment {}

class PaymentFactory {
    /*
    static public function createPayment($choice) {
        if ($choice == "paypal") {
            return new PaypalPayment();
        }
        elseif ($choice == "paypal") {
            return new StripePayment();
        }
    }
     */
    static private $payments = [
        'paypal' => PaypalPayment::class,
        'stripe' => StripePayment::class,
    ];

    static public function createPayment($choice) {
        $class = self::$payments[$choice];
        return new $class;
    }
}

$choice = "paypal";
$payment = PaymentFactory::createPayment($choice);