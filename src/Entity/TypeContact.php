<?php

namespace App\Entity;

use App\Repository\TypeContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeContactRepository::class)
 */
class TypeContact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $string;

    /**
     * @ORM\Column(type="boolean")
     */
    private $obligatoire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $proposeInscription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $validateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getString(): ?string
    {
        return $this->string;
    }

    public function setString(string $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function getObligatoire(): ?bool
    {
        return $this->obligatoire;
    }

    public function setObligatoire(bool $obligatoire): self
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    public function getProposeInscription(): ?bool
    {
        return $this->proposeInscription;
    }

    public function setProposeInscription(bool $proposeInscription): self
    {
        $this->proposeInscription = $proposeInscription;

        return $this;
    }

    public function getValidateur(): ?string
    {
        return $this->validateur;
    }

    public function setValidateur(string $validateur): self
    {
        $this->validateur = $validateur;

        return $this;
    }
}
