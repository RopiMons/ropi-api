<?php

namespace App\Security\Voter;

use App\Entity\Adresse;
use App\Entity\Commerce;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CommerceVoter extends Voter
{
    const VIEW = 'view';
    /**
     * @var AuthorizationCheckerInterface
     */
    private AuthorizationCheckerInterface $checker;

    public function __construct(AuthorizationCheckerInterface $checker)
    {
        $this->checker = $checker;
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [self::VIEW])
            && $subject instanceof Commerce;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        switch ($attribute) {
            case self::VIEW:
                return $this->canView($subject);
        }

        return false;
    }

    private function canView(Commerce $commerce) : bool{
        if(!$commerce->getVisible()){
            return false;
        }
        /** @var Adresse $adresse */
        foreach ($commerce->getAdresses() as $adresse){
            if(!$this->checker->isGranted(AdresseVoter::VIEW_COMMERCE,$adresse)){
                return false;
            }
        }
        return true;
    }
}
