<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="date")
     */
    private $datum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locatie;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_personen;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Training", inversedBy="lesson")
     * @ORM\JoinColumn(nullable=false)
     */
    private $training;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\registration", mappedBy="lesson", orphanRemoval=true)
     */
    private $registration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="lesson")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    public function __construct()
    {
        $this->registration = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getLocatie(): ?string
    {
        return $this->locatie;
    }

    public function setLocatie(string $locatie): self
    {
        $this->locatie = $locatie;

        return $this;
    }

    public function getMaxPersonen(): ?int
    {
        return $this->max_personen;
    }

    public function setMaxPersonen(int $max_personen): self
    {
        $this->max_personen = $max_personen;

        return $this;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        $this->training = $training;

        return $this;
    }

    /**
     * @return Collection|registration[]
     */
    public function getRegistration(): Collection
    {
        return $this->registration;
    }

    public function addRegistration(registration $registration): self
    {
        if (!$this->registration->contains($registration)) {
            $this->registration[] = $registration;
            $registration->setLesson($this);
        }

        return $this;
    }

    public function removeRegistration(registration $registration): self
    {
        if ($this->registration->contains($registration)) {
            $this->registration->removeElement($registration);
            // set the owning side to null (unless already changed)
            if ($registration->getLesson() === $this) {
                $registration->setLesson(null);
            }
        }

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }
}
