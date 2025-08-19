<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ORM\Table(name: 'payments')]
#[ORM\HasLifecycleCallbacks]
class Payment
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $paymentMethod = null;

    #[ORM\Column(length: 30)]
    private ?string $paymentStatus = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $amount = null;

    #[ORM\Column(length: 3)]
    private ?string $currency = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $transactionId = null;

    #[ORM\Column(nullable: true)]
    private ?array $gatewayResponse = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $processedAt = null;

    #[ORM\ManyToOne(inversedBy: 'payments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Order $relatedOrder = null;

    /**
     * @var Collection<int, PaymentRefund>
     */
    #[ORM\OneToMany(targetEntity: PaymentRefund::class, mappedBy: 'payment', orphanRemoval: true)]
    private Collection $refunds;

    public function __construct()
    {
        $this->refunds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): static
    {
        $this->paymentMethod = $paymentMethod;

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

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

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

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function setTransactionId(?string $transactionId): static
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    public function getGatewayResponse(): ?array
    {
        return $this->gatewayResponse;
    }

    public function setGatewayResponse(?array $gatewayResponse): static
    {
        $this->gatewayResponse = $gatewayResponse;

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

    public function getProcessedAt(): ?\DateTime
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?\DateTime $processedAt): static
    {
        $this->processedAt = $processedAt;

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

    /**
     * @return Collection<int, PaymentRefund>
     */
    public function getRefunds(): Collection
    {
        return $this->refunds;
    }

    public function addRefund(PaymentRefund $refund): static
    {
        if (!$this->refunds->contains($refund)) {
            $this->refunds->add($refund);
            $refund->setPayment($this);
        }

        return $this;
    }

    public function removeRefund(PaymentRefund $refund): static
    {
        if ($this->refunds->removeElement($refund)) {
            // set the owning side to null (unless already changed)
            if ($refund->getPayment() === $this) {
                $refund->setPayment(null);
            }
        }

        return $this;
    }
}
