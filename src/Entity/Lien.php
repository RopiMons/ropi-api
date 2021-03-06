<?php

namespace App\Entity;

use App\Repository\LienRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=LienRepository::class)
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Lien
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Serializer\Expose()
     */
    private $url;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSuspicious;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastCheck;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Serializer\Expose()
     */
    private $commentaire;

    /**
     * @var Commerce
     * @ORM\ManyToOne(targetEntity="App\Entity\Commerce", inversedBy="liens")
     */
    private $commerce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIsSuspicious(): ?bool
    {
        return $this->isSuspicious;
    }

    public function setIsSuspicious(bool $isSuspicious): self
    {
        $this->isSuspicious = $isSuspicious;

        return $this;
    }

    public function getLastCheck(): ?\DateTimeInterface
    {
        return $this->lastCheck;
    }

    public function setLastCheck(?\DateTimeInterface $lastCheck): self
    {
        $this->lastCheck = $lastCheck;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

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
