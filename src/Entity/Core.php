<?php

namespace App\Entity;

use App\Repository\CoreRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: CoreRepository::class)]
#[ORM\HasLifecycleCallbacks] // Włącza obsługę callbacków

class Core
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $rel_id = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $warning = null;

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

    public function deleted() {
        $this->deleted = 1;
        $this->del_time = new \DateTime(date("Y-m-d H:i:s"));
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

    public function setBudgetWarning($id, $warn) {      
        $this->type = "budget";
        $this->rel_id = $id;
        $this->warning = $warn;        
    }

    public function setInvoiceWarning($id, $warn) {       
        $this->type = "invoice";
        $this->rel_id = $id;
        $this->warning = $warn;
    } 
    
    public function setContractorWarning($id, $warn) {       
        $this->type = "contractor";
        $this->rel_id = $id;
        $this->warning = $warn;
    } 
     
    public function getType(): ?string
    {
        return $this->type;
    }    

    public function getRel_Id(): ?int
    {
        return $this->rel_id;
    } 

}
