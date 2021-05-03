<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=10)
     *
     * @Assert\NotNull()
     * @Groups({"read:adresse"})
     */
    private string $codePostal;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\NotNull()
     * @Assert\Length(max=100, min=4)
     *
     * @Groups({"read:adresse"})
     */
    private string $ville;


    /**
     * @var Pays
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     *
     * @Assert\Valid()
     *
     * @Assert\NotNull()
     *
     * @Groups({"read:adresse"})
     */
    private Pays $pays;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @Assert\Callback()
     */
    public function callback(ExecutionContextInterface $context, $payload)
    {

        if (empty($this->pays) || empty($this->pays->getRegexCodePostal())) {
            $context->buildViolation('Merci de préciser le pays')->atPath('pays')->addViolation();
        }

        if (preg_match($this->pays->getRegexCodePostal(), $this->codePostal) === (0 | false)) {
            $context->buildViolation('Ce code postal n\'est pas valide pour ce pays')->atPath('codePostal')->addViolation();
        }
    }

}
