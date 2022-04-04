<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ApiResource]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $description;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $estimated_price;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $real_price;

    #[ORM\ManyToOne(targetEntity: Couple::class)]
    #[ORM\JoinColumn(name: "couple_id", referencedColumnName: "id", nullable: true)]
    #[ApiSubresource]
    private ?Couple $couple;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEstimatedPrice(): ?float
    {
        return $this->estimated_price;
    }

    public function setEstimatedPrice(?float $estimated_price): self
    {
        $this->estimated_price = $estimated_price;

        return $this;
    }

    public function getRealPrice(): ?float
    {
        return $this->real_price;
    }

    public function setRealPrice(?float $real_price): self
    {
        $this->real_price = $real_price;

        return $this;
    }

    public function getCouple(): ?Couple
    {
        return $this->couple;
    }

    public function setCouple(?Couple $couple): Event
    {
        $this->couple = $couple;
        return $this;
    }

}
