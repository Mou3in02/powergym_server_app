<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ORM\Table(name: 'app_payment')]
class Payment
{
    const PRICE_HALF_MONTH = 35;
    const PRICE_MONTH = 60;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 100)]
    private string $externalId;

    #[ORM\Column(length: 100)]
    private string $persPersonId;

    #[ORM\Column]
    private ?\DateTime $createTime;

    #[ORM\Column]
    private \DateTime $updateTime;

    #[ORM\Column]
    private ?\DateTime $startTime;

    #[ORM\Column]
    private ?\DateTime $endTime;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?float $price = null;

    #[ORM\Column]
    private bool $isDeleted = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPersPersonId(): string
    {
        return $this->persPersonId;
    }

    public function setPersPersonId(string $persPersonId): static
    {
        $this->persPersonId = $persPersonId;

        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): static
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getCreateTime(): \DateTime
    {
        return $this->createTime;
    }

    public function setCreateTime(\DateTime $createTime): static
    {
        $this->createTime = $createTime;

        return $this;
    }

    public function getUpdateTime(): \DateTime
    {
        return $this->updateTime;
    }

    public function setUpdateTime(\DateTime $updateTime): static
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    public function getStartTime(): ?\DateTime
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTime $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTime
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTime $endTime): static
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): static
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }
}
