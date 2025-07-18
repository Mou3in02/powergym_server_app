<?php

namespace App\Entity;

use App\Repository\FileExecutionRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileExecutionRepository::class)]
#[ORM\Table(name: 'file_execution')]
class FileExecution
{
    const TYPE_IMPORT = 'TYPE_IMPORT';
    const TYPE_EXPORT = 'TYPE_EXPORT';
    const TYPE_MERGE = 'TYPE_MERGE';
    const STATUS_PENDING = 'STATUS_PENDING';
    const STATUS_FAILED = 'STATUS_FAILED';
    const STATUS_SUCCESS = 'STATUS_SUCCESS';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 50, nullable: false)]
    private string $type;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filename = null;

    #[ORM\Column(nullable: true)]
    private ?int $size = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $sizeDescription = null;

    #[ORM\Column(nullable: true)]
    private ?DateTime $createdAt = null;

    #[ORM\Column(nullable: false)]
    private ?bool $isDeleted = false;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(nullable: true)]
    private ?string $executionTime = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $executionTimeDescription = null;

    #[ORM\Column(nullable: true)]
    private ?string $startAt = null;

    #[ORM\Column(nullable: true)]
    private ?string $endAt = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): FileExecution
    {
        $this->id = $id;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): FileExecution
    {
        $this->type = $type;
        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): FileExecution
    {
        $this->filename = $filename;
        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): FileExecution
    {
        $this->size = $size;
        return $this;
    }

    public function getSizeDescription(): ?string
    {
        return $this->sizeDescription;
    }

    public function setSizeDescription(?string $sizeDescription): FileExecution
    {
        $this->sizeDescription = $sizeDescription;
        return $this;
    }

    public function getIsDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): FileExecution
    {
        $this->isDeleted = $isDeleted;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): FileExecution
    {
        $this->status = $status;
        return $this;
    }

    public function getExecutionTime(): ?string
    {
        return $this->executionTime;
    }

    public function setExecutionTime(?string $executionTime): FileExecution
    {
        $this->executionTime = $executionTime;
        return $this;
    }

    public function getExecutionTimeDescription(): ?string
    {
        return $this->executionTimeDescription;
    }

    public function setExecutionTimeDescription(?string $executionTimeDescription): FileExecution
    {
        $this->executionTimeDescription = $executionTimeDescription;
        return $this;
    }

    public function getStartAt(): ?string
    {
        return $this->startAt;
    }

    public function setStartAt(?string $startAt): FileExecution
    {
        $this->startAt = $startAt;
        return $this;
    }

    public function getEndAt(): ?string
    {
        return $this->endAt;
    }

    public function setEndAt(?string $endAt): FileExecution
    {
        $this->endAt = $endAt;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): FileExecution
    {
        $this->createdAt = $createdAt;
        return $this;
    }


}
