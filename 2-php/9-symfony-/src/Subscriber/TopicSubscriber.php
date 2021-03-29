<?php

namespace App\Subscriber;


use App\Event\TopicEvent;
use App\Service\MailerHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TopicSubscriber implements EventSubscriberInterface
{
    private $mailerHelper;

    public function __construct(MailerHelper $mailerHelper)
    {
        $this->mailerHelper = $mailerHelper;
    }

    public static function getSubscribedEvents()
    {
        return [
            TopicEvent::NAME => [
                ['sendEmailAdmin', 3],
                ['updateStat', 1]
            ]
        ];
    }

    public function sendEmailAdmin(TopicEvent $event) {
        $topic = $event->getTopic();
        $this->mailerHelper->send('contact@votredomaine.com', 'to@mail.fr', "contenu html", "title");

    }

    public function updateStat(TopicEvent $event) {
        $topic = $event->getTopic();
        var_dump("updatreStat");
    }
}