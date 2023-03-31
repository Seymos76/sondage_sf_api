<?php

namespace App\Survey\Entity;

use App\Survey\Repository\SurveyResultRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="SurveyResultRepository::class")
 */
class SurveyResult
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column()
     * @Groups("manage")
     */
    private ?int $id = null;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Groups("manager")
     */
    protected \DateTime $created_at;

    public const NAME = "Sondage pour guide multidimensionnel du 3e oeil";

    /**
     * @var array
     * @ORM\Column()
     * @Groups("manage")
     */
    protected array $fields;

    public function __construct()
    {
        $this->fields = [];
        $this->created_at = new \DateTime('now');
    }

    public function build(array $data_fields): self
    {
        foreach ($data_fields as $name => $value) {
            if (!is_string($value)) {
                dump('is array',$value);
                $to_string = "";
                foreach ($value as $key => $text) {
                    $to_string .= $text." ; ";
                }
                dump($to_string);
                $this->fields[$name] = $to_string;
                //$this->addField($name, $to_string);
            } else {
                if ("true" === $value) {
                    $value = "Oui";
                }
                elseif ("false" === $value) {
                    $value = "Non";
                }
                $this->fields[$name] = $value;
                //$this->addField($name, $value);
            }
        }
        return $this;
    }

    private function addField(string $name, mixed $value): void
    {
        if (!$this->fields->containsKey($name)) {
            $this->fields->add([$name => $value]);
        }
    }
}
