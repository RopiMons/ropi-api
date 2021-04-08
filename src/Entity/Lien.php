<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LienRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LienRepository::class)
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read:commerce"}},
 *     collectionOperations={"get"},
 *     itemOperations={
 *          "get" = {"security"="!object.getIsSuspicious()"}
 *      }
 * )
 */
class Lien
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"read:commerce"})
     */
    private string $url;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isSuspicious;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $lastCheck;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * Serializer\Expose()
     */
    private string $commentaire;

    /**
     * @var Commerce
     * @ORM\ManyToOne(targetEntity="App\Entity\Commerce", inversedBy="liens")
     */
    private Commerce $commerce;

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

    public function getLastCheck(): ?DateTimeInterface
    {
        return $this->lastCheck;
    }

    public function setLastCheck(DateTimeInterface $lastCheck): self
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

    public function setCommerce(Commerce $commerce): self
    {
        $this->commerce = $commerce;

        return $this;
    }
}
