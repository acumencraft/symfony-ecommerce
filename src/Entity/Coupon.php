<?php

namespace App\Entity;

use App\Repository\CouponRepository;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
#[ORM\Table(name: 'coupons')]
#[ORM\UniqueConstraint(name: 'UNIQ_COUPON_CODE', columns: ['code'])]
#[UniqueEntity(fields: ['code'], message: 'This coupon code is already in use.')]
#[ORM\HasLifecycleCallbacks]
class Coupon
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $value = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $minimumAmount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $maximumDiscount = null;

    #[ORM\Column(nullable: true)]
    private ?int $usageLimit = null;

    #[ORM\Column]
    private ?int $usageCount = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $startsAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $expiresAt = null;

    /**
     * @var Collection<int, CouponUsage>
     */
    #[ORM\OneToMany(targetEntity: CouponUsage::class, mappedBy: 'coupon')]
    private Collection $usages;

    public function __construct()
    {
        $this->usages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getMinimumAmount(): ?string
    {
        return $this->minimumAmount;
    }

    public function setMinimumAmount(?string $minimumAmount): static
    {
        $this->minimumAmount = $minimumAmount;

        return $this;
    }

    public function getMaximumDiscount(): ?string
    {
        return $this->maximumDiscount;
    }

    public function setMaximumDiscount(?string $maximumDiscount): static
    {
        $this->maximumDiscount = $maximumDiscount;

        return $this;
    }

    public function getUsageLimit(): ?int
    {
        return $this->usageLimit;
    }

    public function setUsageLimit(?int $usageLimit): static
    {
        $this->usageLimit = $usageLimit;

        return $this;
    }

    public function getUsageCount(): ?int
    {
        return $this->usageCount;
    }

    public function setUsageCount(int $usageCount): static
    {
        $this->usageCount = $usageCount;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getStartsAt(): ?\DateTime
    {
        return $this->startsAt;
    }

    public function setStartsAt(?\DateTime $startsAt): static
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    public function getExpiresAt(): ?\DateTime
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?\DateTime $expiresAt): static
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * @return Collection<int, CouponUsage>
     */
    public function getUsages(): Collection
    {
        return $this->usages;
    }

    public function addUsage(CouponUsage $usage): static
    {
        if (!$this->usages->contains($usage)) {
            $this->usages->add($usage);
            $usage->setCoupon($this);
        }

        return $this;
    }

    public function removeUsage(CouponUsage $usage): static
    {
        if ($this->usages->removeElement($usage)) {
            // set the owning side to null (unless already changed)
            if ($usage->getCoupon() === $this) {
                $usage->setCoupon(null);
            }
        }

        return $this;
    }
}
