<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaiementRepository::class)
 */
class Paiement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="float")
     */
    private float $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $dateValeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $referenceComptable;

    /**
     * @var Commande
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="paiements")
     */
    private Commande $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDateValeur(): ?DateTimeInterface
    {
        return $this->dateValeur;
    }

    public function setDateValeur(DateTimeInterface $dateValeur): self
    {
        $this->dateValeur = $dateValeur;

        return $this;
    }

    public function getReferenceComptable(): ?string
    {
        return $this->referenceComptable;
    }

    public function setReferenceComptable(string $referenceComptable): self
    {
        $this->referenceComptable = $referenceComptable;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
