<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
#[ORM\HasLifecycleCallbacks] // Włącza obsługę callbacków
 
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
 
    #[ORM\Column(length: 256)]
    private ?string $uid = null;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    private ?float $amount = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\ManyToOne(targetEntity: Contractor::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contractor $contractor = null;  

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $delayed_date = null;

    #[ORM\Column]
    private ?int $deleted = 0;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $del_time = null;      

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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;
        return $this;
    }    
 
    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;
        return $this;
    }  
    
    public function getuid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): static
    {
        $this->uid = $uid;
        return $this;
    }       

    public function getDelayeddate()
    {
        return $this->delayed_date;
    }

    public function delayed_date() {
        return $this->delayed_date->format('Y-m-d');
    }

    public function setDelayeddate( \DateTime $date): static
    {   $d = (array) $date; 
        $this->delayed_date = new \DateTimeImmutable($d['date']);
        return $this;
    }  

    public function deleted() {
        $this->deleted = 1;
        $this->del_time = new \DateTime(date("Y-m-d H:i:s"));
    }

    public function getContractorId(): ?Contractor
    {   
        return $this->contractor;
    }

    public function setContractorId(Contractor $id): static
    { 
        $this->contractor = $id;
        return $this;
    }  

    public function contractor() {
        return $this->contractor;
    }

    public function setcoluid() 
    {
        $this->uid = uniqid();
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    // Automatyczne ustawianie createdAt przed zapisem
    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    // Automatyczne ustawianie updatedAt przed zapisem i aktualizacją
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }


}
