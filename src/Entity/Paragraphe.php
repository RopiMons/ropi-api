<?php

namespace App\Entity;

use App\Interfaces\Positionnable;
use App\Repository\ParagrapheRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ParagrapheRepository::class)
 *
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"position","page"}, message="Cette position est déjà prise sur cette page")
 *
 * Serializer\ExclusionPolicy("all")
 */
class Paragraphe implements Positionnable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:page:full","read:menu"})
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Groups({"read:page:full","read:menu"})
     */
    private ?string $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private int $position;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"read:page:full"})
     */
    private ?DateTimeInterface $lastUpdate;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"read:page:full"})
     */
    private ?DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $publicationDate;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups({"read:page:full"})
     */
    private ?string $text;

    /**
     * @var PageStatique|null
     * @ORM\ManyToOne(targetEntity="PageStatique", inversedBy="paragraphes")
     */
    private ?PageStatique $page;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getLastUpdate(): ?DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPublicationDate(): ?DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPage(): ?PageStatique
    {
        return $this->page;
    }

    public function setPage(?PageStatique $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    function onPrePersist(){
        $now = new DateTime();
        $this->setCreatedAt($now);
        $this->setLastUpdate($now);
    }

    /**
     * @ORM\PreUpdate()
     */
    function onPreUpdate(){
        $this->setLastUpdate(new DateTime());
    }

    function isActif() :bool{
        return ($this->publicationDate !== null && $this->publicationDate > new DateTime()) ? false : $this->page->getIsActif();
    }
}
