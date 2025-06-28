<?php

namespace App\Entity;

use App\Repository\FileImportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileImportRepository::class)]
#[ORM\Table(name: 'file_import')]
class FileImport
{
    const STATUS_IMPORTED = 'IMPORTED';
    const STATUS_ERROR = 'ERROR';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $originalName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filename = null;

    #[ORM\Column(nullable: true)]
    private ?int $size = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $sizeDescription = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $importedAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDeleted = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): static
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getSizeDescription(): ?string
    {
        return $this->sizeDescription;
    }

    public function setSizeDescription(?string $sizeDescription): static
    {
        $this->sizeDescription = $sizeDescription;

        return $this;
    }

    public function getImportedAt(): ?\DateTime
    {
        return $this->importedAt;
    }

    public function setImportedAt(?\DateTime $importedAt): static
    {
        $this->importedAt = $importedAt;

        return $this;
    }

    public function isDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): static
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
