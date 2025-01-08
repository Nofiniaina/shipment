<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RouteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RouteRepository::class)]
#[ApiResource]
class Route
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $start = null;

    #[ORM\Column(length: 255)]
    private ?string $end = null;

    #[ORM\Column]
    private ?float $distance = null;

    #[ORM\Column(nullable: true)]
    private ?int $estimated = null;

    /**
     * @var Collection<int, Shipment>
     */
    #[ORM\OneToMany(targetEntity: Shipment::class, mappedBy: 'route', orphanRemoval: true)]
    private Collection $shipment;

    public function __construct()
    {
        $this->shipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?string
    {
        return $this->end;
    }

    public function setEnd(string $end): static
    {
        $this->end = $end;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): static
    {
        $this->distance = $distance;

        return $this;
    }

    public function getEstimated(): ?int
    {
        return $this->estimated;
    }

    public function setEstimated(?int $estimated): static
    {
        $this->estimated = $estimated;

        return $this;
    }

    /**
     * @return Collection<int, Shipment>
     */
    public function getShipment(): Collection
    {
        return $this->shipment;
    }

    public function addShipment(Shipment $shipment): static
    {
        if (!$this->shipment->contains($shipment)) {
            $this->shipment->add($shipment);
            $shipment->setRoute($this);
        }

        return $this;
    }

    public function removeShipment(Shipment $shipment): static
    {
        if ($this->shipment->removeElement($shipment)) {
            // set the owning side to null (unless already changed)
            if ($shipment->getRoute() === $this) {
                $shipment->setRoute(null);
            }
        }

        return $this;
    }
}
