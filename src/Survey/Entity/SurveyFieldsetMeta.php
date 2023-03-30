<?php

namespace App\Survey\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Survey\Repository\SurveyFieldsetMetaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SurveyFieldsetMetaRepository::class")
 */
class SurveyFieldsetMeta
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column()
     */
    private ?int $id = null;

    protected string $htmlTag;

    protected string $type;

    protected string $name;

    protected string $dataType;

    protected ?FieldsetConfigurationInterface $fieldsetConfiguration;

    protected ?AnswerInterface $answer;

    public function __construct(array $params)
    {
        $this->htmlTag = $params['html_tag'];
        $this->type = $params['type'];
        $this->name = $params['name'];
        $this->dataType = $params['data_type'];
    }

}
