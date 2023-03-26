<?php

namespace App\Survey\Entity;

use App\Survey\Repository\SurveyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SurveyRepository::class)]
class Survey
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    protected ?string $title;

    protected ?array $fieldsets;

    public function __construct(?string $title)
    {
        $this->title = $title;
    }

    public function addFieldset(?array $fieldset_configuration, ?string $fieldset_label)
    {
        $survey_fieldset = new SurveyFieldset($fieldset_label);
        $survey_fieldset->setConfig($fieldset_configuration);

    }
}
