<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\Api\MenuController;
use App\Interfaces\Positionnable;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

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
 *              "path"="/menu",
 *              "controller"=MenuController::class
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
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:menu"})
     */
    private string $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private int $position;

    /**
     * @var Categorie
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="enfants")
     */
    private Categorie $parent;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Categorie", mappedBy="parent")
     *
     * @Groups({"read:menu"})
     */
    private Collection $enfants;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Page", mappedBy="categorie")
     * @Groups({"read:menu"})
     */
    private Collection $pages;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"read:menu"})
     */
    private string $faIcone;

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

    public function setParent(self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getEnfants(): Collection
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

    public function setEnfants(Collection $enfants): self
    {

        $this->enfants = $enfants;

        foreach ($enfants as $enfant) {
            if ($enfant instanceof Categorie) {
                $enfant->setParent($this);
            }
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
     * @return Collection|Page[]
     */
    public function getPages(): Collection
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

    public function setFaIcone(string $faIcone): self
    {
        $this->faIcone = $faIcone;

        return $this;
    }

    public function setPages(Collection $pages): self
    {
        $this->pages = $pages;

        foreach ($pages as $page) {
            if (get_parent_class($page) === Page::class) {
                $page->setCategorie($this);
            }
        }
        return $this;
    }
}
