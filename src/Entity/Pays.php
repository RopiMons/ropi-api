<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"read:adresse"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $regexCodePostal;

    /**
     * @ORM\Column(type="string", length=10)
     *
     * @Groups({"read:adresse"})
     */
    private $nomCourt;

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

    public function getRegexCodePostal(): ?string
    {
        return $this->regexCodePostal;
    }

    public function setRegexCodePostal(string $regexCodePostal): self
    {
        $this->regexCodePostal = $regexCodePostal;

        return $this;
    }

    public function getNomCourt(): ?string
    {
        return $this->nomCourt;
    }

    public function setNomCourt(string $nomCourt): self
    {
        $this->nomCourt = $nomCourt;

        return $this;
    }
}
