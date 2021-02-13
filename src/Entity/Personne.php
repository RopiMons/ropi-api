<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PersonneRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PersonneRepository::class)
 */
class Personne
{
    const MembreEffectif = 'Membre Effectif';
    const MembreSympathisant = 'Membre Sympathisant';
    const MembreEffectifTemporaire = 'Membre Effectif Temporaire';
    const MembreVolonte = 'Membre Volonté';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *     min=2,
     *     minMessage="Vous devez avoir un nom de min {{ limit }} caractères.",
     *     max =50,
     *     maxMessage="La longeur du nom ne peux pas dépasser {{ limit }} caractères")
     * @Assert\NotBlank(message="Le nom ne peux pas être vide")
     */
    private string $nom;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Length(
     *     min=2,
     *     minMessage="Vous devez avoir un prénom de min {{ limit }} caractères.",
     *     max =50,
     *     maxMessage="La longeur du prénom ne peux pas dépasser {{ limit }} caractères")
     * @Assert\NotBlank(message="Le prénom ne peux pas être vide")
     */
    private string $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private DateTimeInterface $dateNaissance;

    /**
     * @ORM\Column(type="boolean", options={"default":false}))
     */
    private bool $volonteMembre = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $actif;

    /**
     * @var Collection<Adresse>
     * @ORM\ManyToMany(targetEntity="App\Entity\Adresse", inversedBy="personnes")
     */
    private Collection $adresses;

    /**
     * @var Collection<Commande>
     * @ORM\OneToMany  (targetEntity="App\Entity\Commande", mappedBy="personne")
     */
    private Collection $commandes;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="App\Entity\Commerce", inversedBy="admins")
     */
    private Collection $commerces;

    /**
     * @var Collection<Contact>
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="personne")
     */
    private Collection $contacts;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->commerces = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->contacts = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getVolonteMembre(): ?bool
    {
        return $this->volonteMembre;
    }

    public function setVolonteMembre(bool $volonteMembre): self
    {
        $this->volonteMembre = $volonteMembre;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

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

    /**
     * Get adresses
     *
     * @return Collection
     */
    public function getAdresses()
    {
        $retour = new ArrayCollection();

        foreach ($this->adresses as $adresse) {
            if ($adresse->getActif()) {
                $retour->add($adresse);
            }
        }

        return ($retour->count() > 0) ? $retour : null;
    }

    public function getEmail(): ?string
    {
        /* foreach($this->getContacts() as $contact){
             if($contact->getTypeContact()->getValidateur()=="Email"){
                 $mail = $contact->getValeur();
             }
         }*/

        if (isset($mail)) {
            return $mail;
        }

        return null;
    }

    public function getReelAdresses(): ?Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        $this->adresses->removeElement($adress);

        return $this;
    }

    /**
     * @return Collection|Commerce[]
     */
    public function getCommerces(): Collection
    {
        return $this->commerces;
    }

    public function addCommerce(Commerce $commerce): self
    {
        if (!$this->commerces->contains($commerce)) {
            $this->commerces[] = $commerce;
        }

        return $this;
    }

    public function removeCommerce(Commerce $commerce): self
    {
        $this->commerces->removeElement($commerce);

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setPersonne($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getPersonne() === $this) {
                $commande->setPersonne(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setPersonne($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getPersonne() === $this) {
                $contact->setPersonne(null);
            }
        }

        return $this;
    }

}
