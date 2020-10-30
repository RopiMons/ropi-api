<?php

namespace App\Entity;

use App\Interfaces\Positionnable;
use App\Repository\PageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 *
 * @ORM\MappedSuperclass()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"dynamique"="PageDynamique", "statique"="PageStatique"})
 *
 * @UniqueEntity(fields={"titreMenu"}, message="Ce titre est déjà présent dans le menu")
 *
 * @Serializer\ExclusionPolicy("all")
 *
 */
abstract class Page implements Positionnable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $position;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="3", max="25")
     * @Serializer\Expose()
     *
     */
    private ?string $titreMenu;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=156, unique=true)
     * @Gedmo\Slug(fields={"titreMenu"}, unique=true)
     * @Serializer\Expose()
     */
    private ?string $slug;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isActif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getTitreMenu(): ?string
    {
        return $this->titreMenu;
    }

    public function setTitreMenu(string $titreMenu): self
    {
        $this->titreMenu = $titreMenu;

        return $this;
    }

    public function getIsActif(): ?bool
    {
        return $this->isActif;
    }

    public function setIsActif(bool $isActif): self
    {
        $this->isActif = $isActif;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
