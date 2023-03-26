<?php

namespace App\Survey\Entity;

use App\Survey\Repository\SurveyFieldsetMetaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SurveyFieldsetMetaRepository::class)]
class SurveyFieldsetMeta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    protected ?FieldsetConfigurationInterface $fieldsetConfiguration;

    protected ?AnswerInterface $answer;
}
