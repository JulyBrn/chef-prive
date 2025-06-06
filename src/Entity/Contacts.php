<?php

namespace App\Entity;

use App\Repository\ContactsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;

#[ORM\Entity(repositoryClass: ContactsRepository::class)]
class Contacts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 50, minMessage: 'Le nom n\'est pas valide.', maxMessage: 'Le nom n\'est pas valide.')]
    #[Assert\NotBlank( message: 'Ce champ est obligatoire.')]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank( message: 'Ce champ est obligatoire.')]
    #[Assert\Email( message: '{{ value }} n\'est pas un email valide.')]
    private ?string $email = null;

    #[ORM\Column(type:'text',length: 2000)]
    #[Assert\NotBlank( message: 'Ce champ est obligatoire.')]
    #[Assert\Length(min: 10, minMessage: 'Votre message doit faire au moins {{ limit }} caractères.')]
    private ?string $message = null;

    #[ORM\Column(type: "datetime", nullable: false)]
    private ?\DateTime $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Regex( pattern: '/(?:\+33|0)[\s-]?[1-9](?:[\s-]?\d{2}){4}/', message: 'Le numéro de téléphone n\'est pas valide.')]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 50, minMessage: 'Le prenom n\'est pas valide.', maxMessage: 'Le prenom n\'est pas valide.')]
    #[Assert\NotBlank( message: 'Ce champ est obligatoire.')]
    private ?string $prenom = null;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

   
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }
}
