<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext = {"groups"={"read:article:short"}},
 *     itemOperations = {
 *     "get" = {
 *          "method"="GET",
 *          "security"="object.actif()"
 *     }},
 *     collectionOperations = {
 *          "get" = {
 *              "security"="object.actif()"
 *     }}
 * )
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:article:short"})
     */
    private string $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:article:short"})
     */
    private string $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $actif;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"read:article:short"})
     */
    private string $description;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read:article:short"})
     */
    private float $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private int $stock;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }
}
