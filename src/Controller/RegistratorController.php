<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegistratorController extends AbstractController
{
    #[Route(path: '/api/auth/register', name: 'register', methods: 'POST')]
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
