<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Trainee::class, mappedBy="skills")
     */
    private $trainees;

    public function __construct()
    {
        $this->trainees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIdAndName() {
        return $this->id. " - ".$this->getName();
    }

    /**
     * @return Collection|Trainee[]
     */
    public function getTrainees(): Collection
    {
        return $this->trainees;
    }

    public function addTrainee(Trainee $trainee): self
    {
        if (!$this->trainees->contains($trainee)) {
            $this->trainees[] = $trainee;
            $trainee->addSkill($this);
        }

        return $this;
    }

    public function removeTrainee(Trainee $trainee): self
    {
        if ($this->trainees->removeElement($trainee)) {
            $trainee->removeSkill($this);
        }

        return $this;
    }
}
