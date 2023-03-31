<?php

namespace App\Survey\Api;

use App\Survey\Entity\SurveyResult;
use App\Survey\Repository\SurveyResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class SurveyController extends AbstractController
{
    #[Route(path: '/surveys', name: 'api_submit_surveys', methods: 'POST')]
    public function surveys(Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $surveyResult = new SurveyResult();
        $surveyResultToPersist = $surveyResult->build($data);
        $entityManager->persist($surveyResultToPersist);
        $entityManager->flush();
        return $this->json([
            'message' => "Sondage ajouté"
        ], 201);
    }

    #[Route(path: '/surveys/results', name: 'api_survey_results', methods: 'GET')]
    public function surveyResults(SurveyResultRepository $surveyResultRepository)
    {
        $surveyResults = $surveyResultRepository->findAll();
        //dump($surveyResults);
        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();

        $serializer = new Serializer([$normalizer], [$encoder]);
        $serialized = $serializer->serialize($surveyResults, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['created_at']]);
        return $this->json([
            'message' => $serialized
        ]);
    }

    #[Route(path: '/surveys/results/{id}', name: 'api_survey_results_by_id', methods: 'GET')]
    public function surveyResultsById(int $id, SurveyResultRepository $surveyResultRepository)
    {
        $surveyResult = $surveyResultRepository->find($id);
        //dump($surveyResults);
        $normalizer = new ObjectNormalizer();
        $encoder = new JsonEncoder();

        $serializer = new Serializer([$normalizer], [$encoder]);
        $serialized = $serializer->serialize($surveyResult, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['created_at']]);
        return $this->json([
            'result' => $serialized
        ]);
    }

    #[Route(path: '/is-awake', name: 'is_awake', methods: 'GET')]
    public function isAwake()
    {
        return $this->json(['message' => "Server is awake !"], 200);
    }
}
