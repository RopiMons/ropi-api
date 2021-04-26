<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class PersonneDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var PersonneRepository
     */
    private $entityManager;

    /**
     * @var EntityRepository
     */
    private $entityRepository;

    /**
     * EntityPersister constructor.
     * @param EntityManagerInterface $entityManager
     * @param PersonneRepository $entityRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        PersonneRepository $entityRepository
    )
    {

        $this->entityManager = $entityManager;
        $this->entityRepository = $entityRepository;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Personne;
    }

    public function persist($data, array $context = []): Personne
    {

        $record = $this->entityRepository->getIfExist($data->getPrenom());

        if (null !== $record) {
            return $record;
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }

    public function remove($data, array $context = []): void
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
