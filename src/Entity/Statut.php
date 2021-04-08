<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatutRepository::class)
 */
class Statut
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $notifierLeClient;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $notifierAdmin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $delais;

    /**
     * @ORM\Column(type="integer")
     */
    private int $ordre;

    /**
     * @var Collection<Commande>
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="statut")
     */
    private Collection $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNotifierLeClient(): ?bool
    {
        return $this->notifierLeClient;
    }

    public function setNotifierLeClient(bool $notifierLeClient): self
    {
        $this->notifierLeClient = $notifierLeClient;

        return $this;
    }

    public function getNotifierAdmin(): ?bool
    {
        return $this->notifierAdmin;
    }

    public function setNotifierAdmin(bool $notifierAdmin): self
    {
        $this->notifierAdmin = $notifierAdmin;

        return $this;
    }

    public function getDelais(): ?DateTimeInterface
    {
        return $this->delais;
    }

    public function setDelais(DateTimeInterface $delais): self
    {
        $this->delais = $delais;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setStatut($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getStatut() === $this) {
                $commande->setStatut(null);
            }
        }
        return $this;
    }
}
