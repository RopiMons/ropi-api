<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Interfaces\Positionnable;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 * @UniqueEntity(fields={"nom"}, message="Cette catégorie est déjà présente")
 * @UniqueEntity(fields={"parent","position"}, message="Cette possition est déjà occupée")
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read:menu","read:page:short"}},
 *     itemOperations={
 *          "get"
 *      },
 *     collectionOperations={
 *          "get" = {
 *              "path"="/menu"
 *          }
 *     }
 * )
 */
class Categorie implements Positionnable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:menu"})
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @var Categorie
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="enfants")
     */
    private $parent;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Categorie", mappedBy="parent")
     */
    private $enfants;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Page", mappedBy="categorie")
     * @Groups({"read:menu"})
     */
    private $pages;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"read:menu"})
     * @Groups({"read:menu"})
     */
    private $faIcone;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
        $this->pages = new ArrayCollection();
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

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Categorie[]
     */
    public function getEnfants(): \Doctrine\Common\Collections\Collection
    {
        return $this->enfants;
    }

    public function addEnfant(Categorie $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->setParent($this);
        }

        return $this;
    }

    public function removeEnfant(Categorie $enfant): self
    {
        if ($this->enfants->removeElement($enfant)) {
            // set the owning side to null (unless already changed)
            if ($enfant->getParent() === $this) {
                $enfant->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Page[]
     */
    public function getPages(): \Doctrine\Common\Collections\Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setCategorie($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getCategorie() === $this) {
                $page->setCategorie(null);
            }
        }

        return $this;
    }

    public function getFaIcone(): ?string
    {
        return $this->faIcone;
    }

    public function setFaIcone(?string $faIcone): self
    {
        $this->faIcone = $faIcone;

        return $this;
    }
}
