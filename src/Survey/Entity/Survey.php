<?php

namespace App\Survey\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Survey\Repository\SurveyRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="SurveyRepository::class")
 * @UniqueEntity("slug")
 */
class Survey
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column()
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $title;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected ?string $slug = null;

    /**
     * @ORM\Column(type="simple_array")
     * @ORM\ManyToOne(targetEntity="App\Survey\Entity\SurveyFieldset")
     * @ORM\JoinColumn(name="fieldset_id", referencedColumnName="id")
     */
    protected ?array $fieldsets;

    public function __construct(?string $title)
    {
        $this->title = $title;
        $this->slug = (new Slugify())->slugify($title);
        $this->fieldsets = [];
    }

    public function addFieldset(string $fieldset_label, ?array $fieldset_configuration): SurveyFieldset
    {
        $survey_fieldset = new SurveyFieldset($fieldset_label);
        $survey_fieldset->setConfig($fieldset_configuration);
        $this->fieldsets[] = $survey_fieldset;
        return $survey_fieldset;
    }
}
