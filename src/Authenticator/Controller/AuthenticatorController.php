<?php

namespace App\Authenticator\Controller;

use App\Authenticator\Entity\SecurityUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class AuthenticatorController extends AbstractController
{
    #[Route(path: '/auth', name: 'auth')]
    public function authenticate(#[CurrentUser] ?SecurityUser $securityUser, UserPasswordHasherInterface $userPasswordHasher)
    {
        dump($securityUser);
        if (null === $securityUser) {
            return $this->json([
                'message' => "Utilisateur non trouvé."
            ]);
        }
        return $this->json([
            'securityUser' => $securityUser->getEmail()
        ]);
    }
}
