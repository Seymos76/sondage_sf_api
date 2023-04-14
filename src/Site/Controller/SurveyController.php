<?php

namespace App\Site\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SurveyController extends AbstractController
{
    #[Route(path: '/', name: 'homepage')]
    public function homepage()
    {
        return $this->render(
            'site/survey.html.twig'
        );
        return $this->json(['message' => "Survey public page"], 200);
    }
}
