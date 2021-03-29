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
        // faire un traitement uniquement sur certains types d'entité
        if ($topic instanceof Topic) {
            $slug = $this->slugger->slug($topic->getName());
            $topic->setSlug($slug);
        }
    }
}