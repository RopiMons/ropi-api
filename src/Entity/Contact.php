<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $valeur;

    /**
     * @var Collection<Personne>
     * @ORM\ManyToMany(targetEntity="App\Entity\Personne", inversedBy="contacts")
     */
    private Collection $personnes;

    /**
     * @var TypeContact
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeContact")
     */
    private TypeContact $typeContact;

    public function __construct()
    {
        $this->personnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?string
    {
        return $this->valeur;
    }

    public function setValeur(string $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * @Assert\Callback()
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {

        $mdc = $this->typeContact;

        switch ($mdc->getValidateur()) {
            case "Email":
                $emailValidator = new Assert\EmailValidator();
                $emailValidator->initialize($context);

                $emailValidator->validate($this->valeur, new Assert\Email(array(
                    'message' => "Ce mail {{ value }} n'est pas valide"
                )));
                break;

            case "type: integer":
                $integerValidator = new Assert\TypeValidator();
                $integerValidator->initialize($context);
                $integerValidator->validate($this->valeur, new Assert\Type(array(
                    'type' => 'numeric',
                    'message' => "La valeur {{ value }} n'est pas un nombre",
                )));
                break;
            case "":
                break;
            default :
                $context
                    ->buildViolation("Impossible de valider les données")
                    ->atPath("valeur")
                    ->addViolation();
                break;
        }
    }

    /**
     * @return Collection<Personne>
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes[] = $personne;
        }


        return $this;
    }

    public function removePersonne(Personne $personne): self
    {

        $this->personnes->removeElement($personne);

        return $this;
    }

    public function getTypeContact(): ?TypeContact
    {
        return $this->typeContact;
    }

    public function setTypeContact(TypeContact $typeContact): self
    {
        $this->typeContact = $typeContact;

        return $this;
    }
}
