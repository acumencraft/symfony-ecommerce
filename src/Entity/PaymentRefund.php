<?php

namespace App\Entity;

use App\Repository\PaymentRefundRepository;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRefundRepository::class)]
#[ORM\Table(name: 'payment_refunds')]
#[ORM\HasLifecycleCallbacks]
class PaymentRefund
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $amount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reason = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $refundId = null;

    #[ORM\Column(length: 30)]
    private ?string $status = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $processedAt = null;

    #[ORM\ManyToOne(inversedBy: 'refunds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Payment $payment = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): static
    {
        $this->reason = $reason;

        return $this;
    }

    public function getRefundId(): ?string
    {
        return $this->refundId;
    }

    public function setRefundId(?string $refundId): static
    {
        $this->refundId = $refundId;

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

    public function getProcessedAt(): ?\DateTime
    {
        return $this->processedAt;
    }

    public function setProcessedAt(?\DateTime $processedAt): static
    {
        $this->processedAt = $processedAt;

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->payment;
    }

    public function setPayment(?Payment $payment): static
    {
        $this->payment = $payment;

        return $this;
    }
}
