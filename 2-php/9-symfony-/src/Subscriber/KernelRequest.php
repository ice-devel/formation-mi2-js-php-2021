<?php


namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class KernelRequest implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
           KernelEvents::REQUEST => [
                ['onKernelRequest']
            ]
        ];
    }

    public function onKernelRequest(RequestEvent $event) {
        // on passe ici à chaque requête
        if ($event->isMasterRequest()) {
            // requête principale
            // les render dans les templates génère un nouveau
            // kernel.event, mais ce n'est pas la requête master
        }
    }
}