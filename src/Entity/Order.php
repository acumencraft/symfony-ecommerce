<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'orders')]
#[ORM\UniqueConstraint(name: 'UNIQ_ORDER_NUMBER', columns: ['order_number'])]
#[UniqueEntity(fields: ['orderNumber'], message: 'This order number already exists.')]
class Order
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $orderNumber = null;

    #[ORM\Column(length: 30)]
    private ?string $status = null;

    #[ORM\Column(length: 30)]
    private ?string $paymentStatus = null;

    #[ORM\Column(length: 3)]
    private ?string $currency = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $subtotal = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $taxAmount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $shippingAmount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $discountAmount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $total = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(length: 100)]
    private ?string $billingFirstname = null;

    #[ORM\Column(length: 100)]
    private ?string $billingLastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billingCompany = null;

    #[ORM\Column(length: 255)]
    private ?string $billingAddressLine1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $billingAddressLine2 = null;

    #[ORM\Column(length: 100)]
    private ?string $billingCity = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $billingState = null;

    #[ORM\Column(length: 20)]
    private ?string $billingPostalCode = null;

    #[ORM\Column(length: 2)]
    private ?string $billingCountryCode = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $billingPhone = null;

    #[ORM\Column(length: 100)]
    private ?string $shippingLastName = null;

    #[ORM\Column(length: 100)]
    private ?string $shippingFirstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shippingCompany = null;

    #[ORM\Column(length: 255)]
    private ?string $shippingAddressLine1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shippingAddressLine2 = null;

    #[ORM\Column(length: 100)]
    private ?string $shippingCity = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $shippingState = null;

    #[ORM\Column(length: 20)]
    private ?string $shippingPostalCode = null;

    #[ORM\Column(length: 2)]
    private ?string $shippingCountryCode = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $shippingPhone = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $shippedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $deliveredAt = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\OneToMany(mappedBy: 'relatedOrder', targetEntity: OrderItem::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $orderItems;

    /**
     * @var Collection<int, Payment>
     */
    #[ORM\OneToMany(targetEntity: Payment::class, mappedBy: 'relatedOrder', orphanRemoval: true)]
    private Collection $payments;

    #[ORM\OneToOne(mappedBy: 'relatedOrder', cascade: ['persist', 'remove'])]
    private ?Shipment $shipment = null;

    /**
     * @var Collection<int, CouponUsage>
     */
    #[ORM\OneToMany(targetEntity: CouponUsage::class, mappedBy: 'relatedOrder')]
    private Collection $couponUsages;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->couponUsages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): static
    {
        $this->orderNumber = $orderNumber;

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

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(string $paymentStatus): static
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getSubtotal(): ?string
    {
        return $this->subtotal;
    }

    public function setSubtotal(string $subtotal): static
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getTaxAmount(): ?string
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(string $taxAmount): static
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }

    public function getShippingAmount(): ?string
    {
        return $this->shippingAmount;
    }

    public function setShippingAmount(string $shippingAmount): static
    {
        $this->shippingAmount = $shippingAmount;

        return $this;
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

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): static
    {
        $this->total = $total;

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

    public function getBillingFirstname(): ?string
    {
        return $this->billingFirstname;
    }

    public function setBillingFirstname(string $billingFirstname): static
    {
        $this->billingFirstname = $billingFirstname;

        return $this;
    }

    public function getBillingLastname(): ?string
    {
        return $this->billingLastname;
    }

    public function setBillingLastname(string $billingLastname): static
    {
        $this->billingLastname = $billingLastname;

        return $this;
    }

    public function getBillingCompany(): ?string
    {
        return $this->billingCompany;
    }

    public function setBillingCompany(?string $billingCompany): static
    {
        $this->billingCompany = $billingCompany;

        return $this;
    }

    public function getBillingAddressLine1(): ?string
    {
        return $this->billingAddressLine1;
    }

    public function setBillingAddressLine1(string $billingAddressLine1): static
    {
        $this->billingAddressLine1 = $billingAddressLine1;

        return $this;
    }

    public function getBillingAddressLine2(): ?string
    {
        return $this->billingAddressLine2;
    }

    public function setBillingAddressLine2(?string $billingAddressLine2): static
    {
        $this->billingAddressLine2 = $billingAddressLine2;

        return $this;
    }

    public function getBillingCity(): ?string
    {
        return $this->billingCity;
    }

    public function setBillingCity(string $billingCity): static
    {
        $this->billingCity = $billingCity;

        return $this;
    }

    public function getBillingState(): ?string
    {
        return $this->billingState;
    }

    public function setBillingState(?string $billingState): static
    {
        $this->billingState = $billingState;

        return $this;
    }

    public function getBillingPostalCode(): ?string
    {
        return $this->billingPostalCode;
    }

    public function setBillingPostalCode(string $billingPostalCode): static
    {
        $this->billingPostalCode = $billingPostalCode;

        return $this;
    }

    public function getBillingCountryCode(): ?string
    {
        return $this->billingCountryCode;
    }

    public function setBillingCountryCode(string $billingCountryCode): static
    {
        $this->billingCountryCode = $billingCountryCode;

        return $this;
    }

    public function getBillingPhone(): ?string
    {
        return $this->billingPhone;
    }

    public function setBillingPhone(?string $billingPhone): static
    {
        $this->billingPhone = $billingPhone;

        return $this;
    }

    public function getShippingLastName(): ?string
    {
        return $this->shippingLastName;
    }

    public function setShippingLastName(string $shippingLastName): static
    {
        $this->shippingLastName = $shippingLastName;

        return $this;
    }

    public function getShippingFirstName(): ?string
    {
        return $this->shippingFirstName;
    }

    public function setShippingFirstName(string $shippingFirstName): static
    {
        $this->shippingFirstName = $shippingFirstName;

        return $this;
    }

    public function getShippingCompany(): ?string
    {
        return $this->shippingCompany;
    }

    public function setShippingCompany(?string $shippingCompany): static
    {
        $this->shippingCompany = $shippingCompany;

        return $this;
    }

    public function getShippingAddressLine1(): ?string
    {
        return $this->shippingAddressLine1;
    }

    public function setShippingAddressLine1(string $shippingAddressLine1): static
    {
        $this->shippingAddressLine1 = $shippingAddressLine1;

        return $this;
    }

    public function getShippingAddressLine2(): ?string
    {
        return $this->shippingAddressLine2;
    }

    public function setShippingAddressLine2(string $shippingAddressLine2): static
    {
        $this->shippingAddressLine2 = $shippingAddressLine2;

        return $this;
    }

    public function getShippingCity(): ?string
    {
        return $this->shippingCity;
    }

    public function setShippingCity(string $shippingCity): static
    {
        $this->shippingCity = $shippingCity;

        return $this;
    }

    public function getShippingState(): ?string
    {
        return $this->shippingState;
    }

    public function setShippingState(?string $shippingState): static
    {
        $this->shippingState = $shippingState;

        return $this;
    }

    public function getShippingPostalCode(): ?string
    {
        return $this->shippingPostalCode;
    }

    public function setShippingPostalCode(string $shippingPostalCode): static
    {
        $this->shippingPostalCode = $shippingPostalCode;

        return $this;
    }

    public function getShippingCountryCode(): ?string
    {
        return $this->shippingCountryCode;
    }

    public function setShippingCountryCode(string $shippingCountryCode): static
    {
        $this->shippingCountryCode = $shippingCountryCode;

        return $this;
    }

    public function getShippingPhone(): ?string
    {
        return $this->shippingPhone;
    }

    public function setShippingPhone(?string $shippingPhone): static
    {
        $this->shippingPhone = $shippingPhone;

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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, OrderItem>
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): static
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems->add($orderItem);
            $orderItem->setRelatedOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): static
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getRelatedOrder() === $this) {
                $orderItem->setRelatedOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Payment>
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payment $payment): static
    {
        if (!$this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setRelatedOrder($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): static
    {
        if ($this->payments->removeElement($payment)) {
            // set the owning side to null (unless already changed)
            if ($payment->getRelatedOrder() === $this) {
                $payment->setRelatedOrder(null);
            }
        }

        return $this;
    }

    public function getShipment(): ?Shipment
    {
        return $this->shipment;
    }

    public function setShipment(Shipment $shipment): static
    {
        // set the owning side of the relation if necessary
        if ($shipment->getRelatedOrder() !== $this) {
            $shipment->setRelatedOrder($this);
        }

        $this->shipment = $shipment;

        return $this;
    }

    /**
     * @return Collection<int, CouponUsage>
     */
    public function getCouponUsages(): Collection
    {
        return $this->couponUsages;
    }

    public function addCouponUsage(CouponUsage $couponUsage): static
    {
        if (!$this->couponUsages->contains($couponUsage)) {
            $this->couponUsages->add($couponUsage);
            $couponUsage->setRelatedOrder($this);
        }

        return $this;
    }

    public function removeCouponUsage(CouponUsage $couponUsage): static
    {
        if ($this->couponUsages->removeElement($couponUsage)) {
            // set the owning side to null (unless already changed)
            if ($couponUsage->getRelatedOrder() === $this) {
                $couponUsage->setRelatedOrder(null);
            }
        }

        return $this;
    }
}
