<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $licence_plate = null;

    #[ORM\Column]
    private ?float $capacity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLicencePlate(): ?string
    {
        return $this->licence_plate;
    }

    public function setLicencePlate(string $licence_plate): static
    {
        $this->licence_plate = $licence_plate;

        return $this;
    }

    public function getCapacity(): ?float
    {
        return $this->capacity;
    }

    public function setCapacity(float $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }
}
