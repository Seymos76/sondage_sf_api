<?php

namespace App\Survey\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Survey\Repository\AnswerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AnswerRepository::class")
 */
class Answer
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column()
     */
    private ?int $id = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=100)
     */
    protected ?string $type;

    /**
     * @var ArrayCollection
     * @ORM\ManyToOne(targetEntity="App\Survey\Entity\AnswerChoice")
     * @ORM\JoinColumn(name="answer_choices", name="id")
     */
    protected ArrayCollection $choices;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $answer;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
    }

    public function hasManyChoices(): bool
    {
        return 1 < count($this->choices);
    }
}
