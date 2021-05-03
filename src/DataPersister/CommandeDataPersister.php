<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Commande;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class CommandeDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var ContactRepository
     */
    private $entityManager;

    /**
     * @var EntityRepository
     */
    private $entityRepository;

    /**
     * EntityPersister constructor.
     * @param EntityManagerInterface $entityManager
     * @param ContactRepository $entityRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ContactRepository $entityRepository
    )
    {

        $this->entityManager = $entityManager;
        $this->entityRepository = $entityRepository;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Commande;
    }

    /**
     * @param Commande $data
     * @param array $context
     * @return Commande
     */
    public function persist($data, array $context = []): Commande
    {
        return $data;
    }

    /**
     * @param Commande $data
     * @param array $context
     */
    public function remove($data, array $context = []): void
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
