<?php

namespace App\Survey\Entity;

use App\Survey\Repository\SurveyFieldsetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SurveyFieldsetRepository::class)]
class SurveyFieldset
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, unique: true)]
    protected ?string $label;

    protected SurveyFieldsetConfiguration $surveyFieldsetConfiguration;

    protected ?array $options;

    protected ?AnswerInterface $answer;

    public function __construct(?string $label)
    {
        $this->label = $label;
    }

    public function setConfig(array $surveyFieldsetConfiguration)
    {
        $this->surveyFieldsetConfiguration = $surveyFieldsetConfiguration;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getAnswer()
    {
        return $this->answer;
    }
}
