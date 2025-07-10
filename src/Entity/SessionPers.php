<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SessionPers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    private ?User $createdBy = null;


    #[ORM\Column(type: 'string', length: 255)]
    private ?string $id_client = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $first_name = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(type: 'integer')]
    private ?int $price = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_time = null;


    public function getId(): ?int { return $this->id; }

    //public function getIdClient(): ?string { return $this->id_client; }
    //public function setIdClient(?string $id_client): self { $this->id_client = $id_client; return $this; }

    public function getFirstName(): ?string { return $this->first_name; }
    public function setFirstName(?string $first_name): self { $this->first_name = $first_name; return $this; }
    public function getcreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setcreatedBy(?User $user): self
    {
        $this->createdBy =$user;
        return $this;
    }

    public function getLastName(): ?string { return $this->last_name; }
    public function setLastName(?string $last_name): self { $this->last_name = $last_name; return $this; }

    public function getPrice(): ?int { return $this->price; }
    public function setPrice(?int $price): self { $this->price = $price; return $this; }

    public function getDateTime(): ?\DateTimeInterface { return $this->date_time; }
    public function setDateTime(?\DateTimeInterface $date_time): self { $this->date_time = $date_time; return $this; }
}

