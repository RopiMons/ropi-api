<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read:adresse"}},
 *     collectionOperations={},
 *     itemOperations={
 *          "get" = {"security"="is_granted('view_commerce',object)"}
 *      }
 * )
 *
 */
class Adresse
{
    const COMMERCE = 'commerce';
    const FACTURATION = 'facturation';
    const LIVRAISON = 'livraison';


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"read:adresse"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"read:adresse"})
     */
    private string $rue;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $actif;

    /**
     * @ORM\Column(type="string", length=10)
     *
     * @Groups({"read:adresse"})
     */
    private string $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"read:adresse"})
     */
    private ?string $complement;

    /**
     * @var Ville
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville")
     *
     * @Groups({"read:adresse"})
     */
    private Ville $ville;

    /**
     * @var Pays
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     *
     * @Groups({"read:adresse"})
     */
    private Pays $pays;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $typeAdresse;


    /**
     * @var Collection<Personne>
     * @ORM\ManyToMany(targetEntity="App\Entity\Personne", mappedBy="adresses")
     */
    private Collection $personnes;


    /**
     * @var Commerce
     * @ORM\ManyToOne(targetEntity="App\Entity\Commerce", inversedBy="adresses")
     */
    private Commerce $commerce;

    public function __construct()
    {
        $this->personnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): self
    {
        $this->complement = $complement;

        return $this;
    }

    public function getTypeAdresse(): ?string
    {
        return $this->typeAdresse;
    }

    public function setTypeAdresse(string $typeAdresse): self
    {
        $this->typeAdresse = $typeAdresse;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCommerce(): ?Commerce
    {
        return $this->commerce;
    }

    public function setCommerce(Commerce $commerce): self
    {
        $this->commerce = $commerce;

        return $this;
    }

    /**
     * @return Collection|Personne[]
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes[] = $personne;
            $personne->addAdress($this);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): self
    {
        if ($this->personnes->removeElement($personne)) {
            $personne->removeAdress($this);
        }

        return $this;
    }
}
