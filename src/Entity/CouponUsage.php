<?php

namespace App\Entity;

use App\Repository\CouponUsageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponUsageRepository::class)]
class CouponUsage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $discountAmount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $usedAt = null;

    #[ORM\ManyToOne(inversedBy: 'usages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Coupon $coupon = null;

    #[ORM\ManyToOne(inversedBy: 'couponUsages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $relatedOrder = null;

    #[ORM\ManyToOne(inversedBy: 'cuponUsages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    public function __construct()
    {
        $this->usedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiscountAmount(): ?string
    {
        return $this->discountAmount;
    }

    public function setDiscountAmount(string $discountAmount): static
    {
        $this->discountAmount = $discountAmount;

        return $this;
    }

    public function getUsedAt(): ?\DateTime
    {
        return $this->usedAt;
    }

    public function setUsedAt(\DateTime $usedAt): static
    {
        $this->usedAt = $usedAt;

        return $this;
    }

    public function getCoupon(): ?Coupon
    {
        return $this->coupon;
    }

    public function setCoupon(?Coupon $coupon): static
    {
        $this->coupon = $coupon;

        return $this;
    }

    public function getRelatedOrder(): ?Order
    {
        return $this->relatedOrder;
    }

    public function setRelatedOrder(?Order $relatedOrder): static
    {
        $this->relatedOrder = $relatedOrder;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }
}
