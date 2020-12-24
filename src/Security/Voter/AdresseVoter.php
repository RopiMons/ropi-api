<?php

namespace App\Security\Voter;

use App\Entity\Adresse;
use App\Entity\Commerce;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class AdresseVoter extends Voter
{
    const VIEW_COMMERCE = 'view_commerce'; //La vue de cette adresse est demandée via un commerce

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [self::VIEW_COMMERCE])
            && $subject instanceof Adresse;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        switch ($attribute) {
            case self::VIEW_COMMERCE:
                return $this->canViewCommerce($subject);
        }

        return false;
    }

    private function canViewCommerce(Adresse $adresse) : bool{
        return
            $adresse->getTypeAdresse() === Adresse::COMMERCE &&
            $adresse->getActif() &&
            $adresse->getCommerce() instanceof Commerce
            ;
    }
}
