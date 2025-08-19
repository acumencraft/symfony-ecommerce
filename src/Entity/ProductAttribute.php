<?php

namespace App\Entity;

use App\Repository\ProductAttributeRepository;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: ProductAttributeRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'product_attributes')]
#[ORM\UniqueConstraint(name: 'UNIQ_PRODUCT_ATTRIBUTE_SLUG', columns: ['slug'])]
#[UniqueEntity(fields: ['slug'], message: 'This slug is already in use.')]
class ProductAttribute
{
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $slug = null;

    #[ORM\Column(length: 20)]
    private ?string $type = null;

    #[ORM\Column]
    private ?bool $isRequired = null;

    #[ORM\Column]
    private ?bool $isFilterable = null;

    #[ORM\Column]
    private ?int $sortOrder = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

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

    public function isRequired(): ?bool
    {
        return $this->isRequired;
    }

    public function setIsRequired(bool $isRequired): static
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    public function isFilterable(): ?bool
    {
        return $this->isFilterable;
    }

    public function setIsFilterable(bool $isFilterable): static
    {
        $this->isFilterable = $isFilterable;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): static
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
