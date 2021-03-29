<?php

namespace App\Security\Voter;

use App\Entity\Topic;
use Doctrine\Migrations\Tools\Console\Exception\InvalidOptionUsage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TopicVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['TOPIC_EDIT'])
            && $subject instanceof \App\Entity\Topic;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'TOPIC_EDIT':
                return $this->canEdit($user, $subject);
                break;
        }

        return false;
    }

    public function canEdit($user, Topic $topic) {
        /*
        $lastYear = new \DateTime("1 year ago");
        $createdAt = $topic->getCreatedAt();
        $interval = $createdAt->diff($createdAt);
         */

        return $user->getId() === $topic->getUser()->getId();
    }
}
