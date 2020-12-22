<?php

namespace App\Entity;

use App\Repository\PageDynamiqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageDynamiqueRepository::class)
 */
class PageDynamique extends Page
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $route;

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getType() : string
    {
        return 'page_dynamique';
    }
}
