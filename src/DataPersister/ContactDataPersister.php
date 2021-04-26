<?php


namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Contact;
use App\Entity\Personne;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ContactDataPersister implements ContextAwareDataPersisterInterface
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
        return $data instanceof Contact;
    }

    /**
     * @param Contact $data
     * @param array $context
     * @return Contact
     */
    public function persist($data, array $context = []): Contact
    {

        /** @var null|Contact $record */
        $record = $this->entityRepository->findOneBy([
            'valeur' => strtolower($data->getValeur())
        ]);

        if (null !== $record) {
            /** @var Personne $personne */
            foreach ($data->getPersonnes() as $personne) {
                $record->addPersonne($personne);
            }
        } else {
            $record = $data;
            $record->setValeur(strtolower($data->getValeur()));
        }

        $this->entityManager->persist($record);
        $this->entityManager->flush();

        return $record;
    }

    public function remove($data, array $context = []): void
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}
