<?php

namespace App\Entity;

use App\Repository\SeancePersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SeancePersRepository::class)]
class SeancePers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+$/',
        message: 'Le nom doit contenir uniquement des lettres.'
    )]
    private ?string $first_name = null;

    #[ORM\Column(length: 500)]
    #[Assert\NotBlank(message: 'Le prénom est obligatoire.')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+$/',
        message: 'Le prénom doit contenir uniquement des lettres.'
    )]
    private ?string $last_name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 50)]
    private ?string $id_admin = null;

    #[ORM\Column]
    private ?\DateTime $date_time = null;

    // -- getters and setters --

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;
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

    public function getIdAdmin(): ?string
    {
        return $this->id_admin;
    }

    public function setIdAdmin(string $id_admin): static
    {
        $this->id_admin = $id_admin;
        return $this;
    }

    public function getDateTime(): ?\DateTime
    {
        return $this->date_time;
    }

    public function setDateTime(\DateTime $date_time): static
    {
        $this->date_time = $date_time;
        return $this;
    }
}
