<?php


namespace App\DTO;


use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class CommandeInput
{
    /**
     * @var int
     *
     * @Assert\NotBlank(
     *     message="Merci de renseigner la personne",
     *     allowNull=false
     * )
     *
     * @Assert\Type(
     *     type="integer",
     *     message="Le format de l'id n'est pas correcte"
     * )
     *
     * @Assert\Positive()
     *
     */
    public int $personne;

    /**
     * @var int
     * @Assert\NotBlank(
     *     message="Merci de renseigner le contact de préférence",
     *     allowNull=false
     * )
     *
     * @Assert\Type(
     *     type="integer",
     *     message="Le format de l'id n'est pas correcte"
     * )
     *
     * @Assert\Positive()
     *
     */
    public int $contact;

    /**
     * @var array
     *
     * @Assert\NotBlank(
     *     message="Merci de renseigner les articles composants la commande",
     *     allowNull=false
     * )
     *
     * @Assert\Type(
     *     type="array",
     *     message="Merci de fournir un tableau"
     * )
     */
    public array $articles;

    /**
     * @var int|null
     *
     * @Assert\Type(
     *     type="integer",
     *     message="Le format de l'id n'est pas correcte"
     * )
     *
     * @Assert\Positive()
     */
    public ?int $depot;

    /**
     * @var null|string
     *
     * @Assert\Length(max=254, min=4)
     *
     * @Assert\NotNull()
     *
     * @Assert\Regex(pattern="/^.*(\d)+(.)*$/", message="N'oubliez pas de mettre votre numéro de maison")
     *
     */
    public ?string $rueNumero;

    /**
     * @var string|null
     *
     * @Assert\Length(max=100, min=4)
     */
    public ?string $ville;

    /**
     * @var null|int
     *
     * @Assert\Type(
     *     type="integer",
     *     message="Le format de l'id n'est pas correcte"
     * )
     *
     * @Assert\Positive()
     *
     * @Assert\Regex("/^[1-9]\d{3}$/")
     * @Assert\GreaterThanOrEqual(value="1000")
     * @Assert\LessThanOrEqual(value="9992")
     *
     */
    public ?int $codePostal;

    /**
     * @Assert\Callback()
     */
    public function callback(ExecutionContextInterface $context, $payload): void
    {
        if (empty($this->depot) && (empty($this->codePostal) || empty($this->rueNumero) || empty($this->ville))) {
            $context->buildViolation('Merci de choissir un moyen de livraison')->addViolation();
        }
    }

}
