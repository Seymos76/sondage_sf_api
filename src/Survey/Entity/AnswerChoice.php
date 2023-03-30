<?php

namespace App\Survey\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Survey\Repository\AnswerChoiceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AnswerChoiceRepository::class")
 */
class AnswerChoice
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column()
     */
    private ?int $id = null;

    protected string $label;

    protected string $value;

    public function __construct(string $label, string $value)
    {
        $this->label = $label;
        $this->value = $value;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
