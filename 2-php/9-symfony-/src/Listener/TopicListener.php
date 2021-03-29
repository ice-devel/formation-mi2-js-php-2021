<?php
namespace App\Listener;

use App\Entity\Topic;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class TopicListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Topic $topic, LifecycleEventArgs $args) {
        var_dump("listener topic");exit;
        // faire un traitement uniquement sur certains types d'entité
        if ($entity instanceof Topic) {
            $slug = $this->slugger->slug($entity->getName());
            $entity->setSlug($slug);
        }
    }
}