<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Repository\CommerceRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommerceRepository::class)
 *
 * @ApiFilter(filterClass=BooleanFilter::class, properties={"isComptoir"})
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
    private int $id;

    /**
     * @ORM\Column(type="string", length=150)
     *
     * @Groups({"read:commerce"})
     */
    private string $nom;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private string $slogan;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private string $textColor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private string $logo;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $visible;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"read:commerce"})
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"read:commerce"})
     */
    private DateTimeInterface $updateAt;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private float $lat;

    /**
     * @ORM\Column(type="float", nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private float $lon;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Lien", mappedBy="commerce")
     *
     * @Groups({"read:commerce"})
     */
    private Collection $liens;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="commerce")
     *
     * @Groups({"read:adresse"})
     */
    private Collection $adresses;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"read:commerce"})
     */
    private string $bgImage;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups({"read:commerce"})
     */
    private bool $isComptoir;

    /**
     * @var Collection<Personne>
     * @ORM\ManyToMany(targetEntity="App\Entity\Personne", mappedBy="commerces")
     */
    private Collection $admins;


    public function __construct()
    {
        $this->liens = new ArrayCollection();
        $this->adresses = new ArrayCollection();
        $this->admins = new ArrayCollection();
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

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
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

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function setLon(float $lon): self
    {
        $this->lon = $lon;

        return $this;
    }

    public function getBgImage(): ?string
    {
        return $this->bgImage;
    }

    public function setBgImage(string $bgImage): self
    {
        $this->bgImage = $bgImage;

        return $this;
    }

    public function getIsComptoir(): ?bool
    {
        return $this->isComptoir;
    }

    public function setIsComptoir(bool $isComptoir): self
    {
        $this->isComptoir = $isComptoir;

        return $this;
    }

    /**
     * @return Collection|Lien[]
     */
    public function getLiens(): Collection
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
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdresse(Adresse $adresse): self
    {
        if (!$this->adresses->contains($adresse)) {
            $this->adresses[] = $adresse;
            $adresse->setCommerce($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): self
    {
        if ($this->adresses->removeElement($adresse)) {
            // set the owning side to null (unless already changed)
            if ($adresse->getCommerce() === $this) {
                $adresse->setCommerce(null);
            }
        }

        return $this;
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

    /**
     * @return Collection|Personne[]
     */
    public function getAdmins(): Collection
    {
        return $this->admins;
    }

    public function addAdmin(Personne $admin): self
    {
        if (!$this->admins->contains($admin)) {
            $this->admins[] = $admin;
            $admin->addCommerce($this);
        }

        return $this;
    }

    public function removeAdmin(Personne $admin): self
    {
        if ($this->admins->removeElement($admin)) {
            $admin->removeCommerce($this);
        }

        return $this;
    }
}
