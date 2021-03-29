<?php

namespace App\Event;

use App\Entity\Topic;
use Symfony\Contracts\EventDispatcher\Event;

class TopicEvent extends Event
{
    public const NAME = 'topic.created';

    protected Topic $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function getTopic(): Topic
    {
        return $this->topic;
    }
}