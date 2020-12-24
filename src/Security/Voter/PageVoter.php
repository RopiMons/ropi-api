<?php

namespace App\Security\Voter;

use App\Entity\Page;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class PageVoter extends Voter
{
    const VIEW = 'view';

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [self::VIEW])
            && $subject instanceof Page;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        switch ($attribute) {
            case self::VIEW:
                return $this->canView($subject);
        }

        return false;
    }

    private function canView(Page $page){
        return $page->getIsActif();
    }
}
