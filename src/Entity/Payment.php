<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ORM\Table(name: "app_payment")]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $externalId = null;

    #[ORM\ManyToOne(targetEntity: PersPerson::class)]
    #[ORM\JoinColumn(name: "pers_person_id", referencedColumnName: "id", nullable: false)]
    private ?PersPerson $persPerson = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $createTime = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $startTime = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $endTime = null;

    #[ORM\Column(type: "integer")]
    private ?int $days = null;

    // === Getters / setters ===

    public function getId(): ?int { return $this->id; }

    public function getExternalId(): ?string { return $this->externalId; }
    public function setExternalId(string $externalId): self { $this->externalId = $externalId; return $this; }

    public function getPersPerson(): ?PersPerson { return $this->persPerson; }
    public function setPersPerson(?PersPerson $persPerson): self { $this->persPerson = $persPerson; return $this; }

    public function getCreateTime(): ?\DateTimeInterface { return $this->createTime; }
    public function setCreateTime(\DateTimeInterface $createTime): self { $this->createTime = $createTime; return $this; }

    public function getStartTime(): ?\DateTimeInterface { return $this->startTime; }
    public function setStartTime(\DateTimeInterface $startTime): self { $this->startTime = $startTime; return $this; }

    public function getEndTime(): ?\DateTimeInterface { return $this->endTime; }
    public function setEndTime(\DateTimeInterface $endTime): self { $this->endTime = $endTime; return $this; }

    public function getDays(): ?int { return $this->days; }
    public function setDays(int $days): self { $this->days = $days; return $this; }
}
