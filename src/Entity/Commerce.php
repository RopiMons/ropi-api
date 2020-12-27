<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommerceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Collection;

/**
 * @ORM\Entity(repositoryClass=CommerceRepository::class)
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read:commerce","read:adresse"}},
 *     collectionOperations={"get"},
 *     itemOperations={
 *     "get" = {"security"="is_granted('view',object)"}
 *      }
 * )
*/
class Commerce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups({"read:commerce"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     *
     * @Groups({"read:commerce"})
     */
    private $nom;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private $slogan;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private $textColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private $logo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"read:commerce"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"read:commerce"})
     */
    private $updateAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private $lat;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private $lon;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Lien", mappedBy="commerce")
     *
     * @Groups({"read:commerce"})
     */
    private $liens;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="commerce")
     *
     * @Groups({"read:adresse"})
     */
    private $adresses;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private $bgImage;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({"read:commerce"})
     */
    private $isComptoire;

    public function __construct()
    {
        $this->liens = new ArrayCollection();
        $this->adresses = new ArrayCollection();
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

    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(?string $siteWeb): self
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(?string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(?string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }

    public function getLienFB(): ?string
    {
        return $this->lienFB;
    }

    public function setLienFB(?string $lienFB): self
    {
        $this->lienFB = $lienFB;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(?float $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    public function getBgImage(): ?string
    {
        return $this->bgImage;
    }

    public function setBgImage(?string $bgImage): self
    {
        $this->bgImage = $bgImage;

        return $this;
    }

    public function getIsComptoire(): ?bool
    {
        return $this->isComptoire;
    }

    public function setIsComptoire(bool $isComptoire): self
    {
        $this->isComptoire = $isComptoire;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Lien[]
     */
    public function getLiens(): \Doctrine\Common\Collections\Collection
    {
        return $this->liens;
    }

    public function addLien(Lien $lien): self
    {
        if (!$this->liens->contains($lien)) {
            $this->liens[] = $lien;
            $lien->setCommerce($this);
        }

        return $this;
    }

    public function removeLien(Lien $lien): self
    {
        if ($this->liens->removeElement($lien)) {
            // set the owning side to null (unless already changed)
            if ($lien->getCommerce() === $this) {
                $lien->setCommerce(null);
            }
        }

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Adresse[]
     */
    public function getAdresses(): \Doctrine\Common\Collections\Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setCommerce($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getCommerce() === $this) {
                $adress->setCommerce(null);
            }
        }

        return $this;
    }
    public function removeAdresse(Adresse $adresse): self{
        return $this->removeAdress($adresse);
    }

    public function addAdresse(Adresse $adresse): self{
        return $this->addAdress($adresse);
    }
}
