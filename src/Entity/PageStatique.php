<?php

namespace App\Entity;

use App\Repository\PageStatiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageStatiqueRepository::class)
 */
class PageStatique extends Page
{

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Paragraphe", mappedBy="page")
     */
    private ArrayCollection $paragraphes;

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

}
