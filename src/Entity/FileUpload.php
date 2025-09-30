<?php

namespace App\Entity;

use App\Repository\FileUploadRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileUploadRepository::class)]
#[ORM\Table(name: 'app_file_upload')]
class FileUpload
{
    const STATUS_PENDING = 'PENDING';
    const STATUS_ERROR = 'ERROR';
    const STATUS_FINISHED = 'FINISHED';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $originalName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filename = null;

    #[ORM\Column(nullable: true)]
    private ?int $size = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $sizeDescription = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $uploadedAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDeleted = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(name: 'is_by_service' ,type: 'boolean', nullable: false, options: ['default' => false])]
    private bool $isByService = false;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'uploaded_by', referencedColumnName: 'id', nullable: false, onDelete: 'SET NULL')]
    private ?User $uploadedBy = null;

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

    public function getUploadedAt(): ?\DateTime
    {
        return $this->uploadedAt;
    }

    public function setUploadedAt(?\DateTime $uploadedAt): static
    {
        $this->uploadedAt = $uploadedAt;

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

    public function isByService(): bool
    {
        return $this->isByService;
    }

    public function setIsByService(bool $isByService): FileUpload
    {
        $this->isByService = $isByService;
        return $this;
    }

    public function getUploadedBy(): ?User
    {
        return $this->uploadedBy;
    }

    public function setUploadedBy(?User $uploadedBy): static
    {
        $this->uploadedBy = $uploadedBy;

        return $this;
    }

}
