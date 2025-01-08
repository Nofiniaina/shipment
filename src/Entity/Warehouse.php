<?php

namespace App\Entity;

use App\Repository\WarehouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WarehouseRepository::class)]
class Warehouse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column(nullable: true)]
    private ?int $current_inventory = null;

    /**
     * @var Collection<int, Shipment>
     */
    #[ORM\OneToMany(targetEntity: Shipment::class, mappedBy: 'warehouse')]
    private Collection $shipment;

    public function __construct()
    {
        $this->shipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getCurrentInventory(): ?int
    {
        return $this->current_inventory;
    }

    public function setCurrentInventory(?int $current_inventory): static
    {
        $this->current_inventory = $current_inventory;

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
            $shipment->setWarehouse($this);
        }

        return $this;
    }

    public function removeShipment(Shipment $shipment): static
    {
        if ($this->shipment->removeElement($shipment)) {
            // set the owning side to null (unless already changed)
            if ($shipment->getWarehouse() === $this) {
                $shipment->setWarehouse(null);
            }
        }

        return $this;
    }
}
