<?php

namespace App\Survey\Controller;

use App\Survey\Form\SurveyFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SurveyController extends AbstractController
{
    #[Route(path: '/survey', name: 'sondage')]
    public function surveyForm(): Response
    {
        //$surveyForm = $this->createForm(SurveyFormType::class);
        return $this->render(
            'site/survey.html.twig',
            //['form' => $surveyForm->createView()]
        );
    }
}
