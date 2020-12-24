<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read:adresse"}},
 *     collectionOperations={},
 *     itemOperations={"get"}
 * )
 * @todo dès que possible, il faut faire un is_granted('view_commerce',object). Pour l'instant le NullToken n'est pas recunnu par API_PLATEFORME
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
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"read:adresse"})
     */
    private $rue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\Column(type="string", length=10)
     *
     * @Groups({"read:adresse"})
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"read:adresse"})
     */
    private $complement;

    /**
     * @var Ville
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville")
     *
     * @Groups({"read:adresse"})
     */
    private $ville;

    /**
     * @var Pays
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     *
     * @Groups({"read:adresse"})
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $typeAdresse;

    /**
     * @var Commerce
     * @ORM\ManyToOne(targetEntity="App\Entity\Commerce", inversedBy="adresses")
     */
    private $commerce;

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

    public function setComplement(?string $complement): self
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

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getCommerce(): ?Commerce
    {
        return $this->commerce;
    }

    public function setCommerce(?Commerce $commerce): self
    {
        $this->commerce = $commerce;

        return $this;
    }
}
