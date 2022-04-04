<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CoupleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: CoupleRepository::class)]
#[ApiResource]
class Couple
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $manName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $womanName;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $updatedAt;

    #[ORM\OneToMany(mappedBy: 'couple', targetEntity: Event::class)]
    private Collection $events;

    #[Pure]
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManName(): ?string
    {
        return $this->manName;
    }

    public function setManName(string $manName): self
    {
        $this->manName = $manName;

        return $this;
    }

    public function getWomanName(): ?string
    {
        return $this->womanName;
    }

    public function setWomanName(string $womanName): self
    {
        $this->womanName = $womanName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addCouple(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setCouple($this);
        }
        return $this;
    }

    public function removeName(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            if ($event->getCouple() === $this) {
                $event->setCouple(null);
            }
        }

        return $this;
    }
}
