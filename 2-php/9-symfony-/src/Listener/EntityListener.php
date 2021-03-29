<?php
namespace App\Listener;

use Doctrine\Persistence\Event\LifecycleEventArgs;

class EntityListener
{
    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getObject();

        // faire quelquechose pour toutes les entités
    }
}