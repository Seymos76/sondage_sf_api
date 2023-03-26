<?php

namespace App\Survey\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Survey\Entity\Survey;
use Doctrine\ORM\EntityManagerInterface;

class SurveyController extends AbstractController
{
    #[Route(path: '/api/surveys', name: 'surveys', methods: 'POST')]
    public function surveys(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $newSurvey = $serializer->deserialize($request->getContent(), Survey::class, 'json');
        $entityManager->persist($newSurvey);
        $entityManager->flush();
        return $this->json([
            'survey' => $newSurvey
        ]);
    }
}
