<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PageStatiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PageStatiqueRepository::class)
 *
 * @ApiResource(
 *     collectionOperations={"post"},
 *     itemOperations={"put","patch",
 *          "get" = {
 *              "security"="is_granted('view',object)",
 *              "normalization_context"={"groups"={"read:page:full","read:page:short"}},
 *              "method"="GET",
 *              "path"="/page_statiques/{id}"
 *          }
 *      }
 * )
 *
 */
class PageStatique extends Page
{

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Paragraphe", mappedBy="page")
     *
     * @Groups({"read:page:full","read:menu"})
     */
    private Collection $paragraphes;

    public function __construct()
    {
        $this->paragraphes = new ArrayCollection();
    }

    /**
     * @return Collection|Paragraphe[]
     */
    public function getParagraphes(): Collection
    {
        return $this->paragraphes;
    }

    public function addParagraphe(Paragraphe $paragraphe): self
    {
        if (!$this->paragraphes->contains($paragraphe)) {
            $this->paragraphes[] = $paragraphe;
            $paragraphe->setPage($this);
        }

        return $this;
    }

    public function removeParagraphe(Paragraphe $paragraphe): self
    {
        if ($this->paragraphes->removeElement($paragraphe)) {
            // set the owning side to null (unless already changed)
            if ($paragraphe->getPage() === $this) {
                $paragraphe->setPage(null);
            }
        }

        return $this;
    }

    public function getType() : string
    {
        return 'page_statique';
    }
}
