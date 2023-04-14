<?php

namespace App\Tests\Survey\Api;

use App\Survey\Repository\SurveyRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Request;

class SurveyControllerTest extends WebTestCase
{
    public function testPostSurveyResult()
    {
        self::bootKernel();

        $container = static::getContainer();
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/surveys',
            [],
            [],
            [],
        );
        $request = new Request('uri', 'POST',[],[],[],[],$content);
    }

    public function testGetSurveys()
    {

        self::bootKernel();
        $container = static::getContainer();
        $client = static::createClient();
        $surveyRepository = $container->get(SurveyRepository::class);
        $surveyList = $surveyRepository->findAll();
        $client->xmlHttpRequest('GET', '/api/surveys',
            [],
            [],
            [],
            $surveyList
        );
        $response = $client->getResponse();
        $this->assertGreaterThan(0,strlen($response->getContent()));
    }
}
