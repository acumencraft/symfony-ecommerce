<?php

namespace App\Entity;

use App\Repository\ShipmentRepository;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShipmentRepository::class)]
#[ORM\Table(name: 'shipments')]
#[ORM\HasLifecycleCallbacks]
class Shipment
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $trackingNumber = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $carrier = null;

    #[ORM\Column(length: 30)]
    private ?string $status = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $shippedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $deliveredAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\OneToOne(inversedBy: 'shipment', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $relatedOrder = null;


    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ShippingMethod $shippingMethod = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(?string $trackingNumber): static
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    public function setCarrier(?string $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getShippedAt(): ?\DateTime
    {
        return $this->shippedAt;
    }

    public function setShippedAt(?\DateTime $shippedAt): static
    {
        $this->shippedAt = $shippedAt;

        return $this;
    }

    public function getDeliveredAt(): ?\DateTime
    {
        return $this->deliveredAt;
    }

    public function setDeliveredAt(?\DateTime $deliveredAt): static
    {
        $this->deliveredAt = $deliveredAt;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getRelatedOrder(): ?Order
    {
        return $this->relatedOrder;
    }

    public function setRelatedOrder(Order $relatedOrder): static
    {
        $this->relatedOrder = $relatedOrder;

        return $this;
    }



    public function getShippingMethod(): ?ShippingMethod
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(?ShippingMethod $shippingMethod): static
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }
}
