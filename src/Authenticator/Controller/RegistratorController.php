<?php

namespace App\Authenticator\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegistratorController extends AbstractController
{
    #[Route(path: '/auth/register', name: 'register', methods: 'POST')]
    public function register(Request $request)
    {
        dump($request->attributes);
        dump($request->request);
        dump($request->getContent());
        return $this->json([
            'route' => 'register'
        ]);
    }
}
