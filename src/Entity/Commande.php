<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
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
    private string $refCommande;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updatedAt;

    /**
     * @var Statut
     * @ORM\ManyToOne(targetEntity="App\Entity\Statut", inversedBy="commandes")
     */
    private Statut $statut;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $archive;

    /**
     * @var Personne
     * @ORM\ManyToOne(targetEntity="App\Entity\Personne", inversedBy="commandes")
     */
    private Personne $personne;

    /**
     * @var Adresse
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse")
     */
    private Adresse $adresseDeLivraison;

    /**
     * @var Collection<Paiement>
     * @ORM\OneToMany(targetEntity="App\Entity\Paiement", mappedBy="commande")
     */
    private Collection $paiements;

    public function __construct()
    {
        $this->paiements = new ArrayCollection();
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

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function calcRefCommande()
    {
        $annee = date('Y');
        $id = $this->getId();
        $chaine = $annee . $id;
        $boucle = 6 - ceil(log10($id));

        while ($boucle) {
            $chaine = substr_replace($chaine, "0", 4, 0);
            $boucle -= 1;
        }
        $modulo = (int)$chaine % 97;

        if (ceil(log10($modulo)) == 1) {
            $modulo = substr_replace($modulo, "0", 0, 0);
        }

        $chaine = substr_replace($chaine, $modulo, 10, 0);
        $this->setRefCommande($chaine);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComStructure()
    {
        $communication = $this->getRefCommande();
        return "+++" . substr($communication, 0, 3) . "/" . substr($communication, 3, 4) . "/" . substr($communication, 7, 5) . "+++";
    }

    public function getRefCommande(): ?string
    {
        return $this->refCommande;
    }

    public function setRefCommande(string $refCommande): self
    {
        $this->refCommande = $refCommande;

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(Statut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Paiement[]
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements[] = $paiement;
            $paiement->setCommande($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getCommande() === $this) {
                $paiement->setCommande(null);
            }
        }

        return $this;
    }

    public function getAdresseDeLivraison(): ?Adresse
    {
        return $this->adresseDeLivraison;
    }

    public function setAdresseDeLivraison(Adresse $adresseDeLivraison): self
    {
        $this->adresseDeLivraison = $adresseDeLivraison;

        return $this;
    }

    /**
     * @return Personne
     */
    public function getPersonne(): Personne
    {
        return $this->personne;
    }

    public function setPersonne(Personne $personne): self
    {
        $this->personne = $personne;
        return $this;
    }

}
