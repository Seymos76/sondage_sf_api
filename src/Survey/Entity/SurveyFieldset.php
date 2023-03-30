<?php

namespace App\Survey\Entity;

use App\Survey\Repository\SurveyFieldsetRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Metadata\ApiResource;

/**
 * @ORM\Entity(repositoryClass="SurveyFieldsetRepository::class")
 * @UniqueEntity("slug")
 */
class SurveyFieldset
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column()
     */
    private ?int $id = null;

    #[ORM\Column(length: 200, unique: true)]
    protected ?string $label;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    protected ?string $slug = null;

    #[ORM\OneToOne(targetEntity: SurveyFieldsetMeta::class)]
    #[ORM\JoinColumn(name: 'survey_fieldset_meta', referencedColumnName: 'id')]
    protected ?SurveyFieldsetMeta $surveyFieldsetMeta;

    #[ORM\OneToOne(targetEntity: Answer::class)]
    #[ORM\JoinColumn(name: 'survey_fieldset_answer', referencedColumnName: 'id')]
    protected ?Answer $answer;

    public function __construct(?string $label)
    {
        $this->label = $label;
        $this->slug = (new Slugify())->slugify($label);
        $this->answer = new Answer();
    }

    public function setConfig(array $surveyFieldsetMeta): void
    {
        $this->surveyFieldsetMeta = new SurveyFieldsetMeta($surveyFieldsetMeta);
    }

    public function getConfig(): ?SurveyFieldsetMeta
    {
        return $this->surveyFieldsetMeta;
    }

    public function getAnswer(): Answer
    {
        return $this->answer;
    }
}
