<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Adresse;
use App\Repository\AdresseRepository;
use Doctrine\Persistence\ManagerRegistry;

class AdresseItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if(!$this->supports($resourceClass)){
            throw  new ResourceClassNotSupportedException();
        }
        /** @var AdresseRepository $adresseRepository */
        $adresseRepository = $this->managerRegistry->getRepository(Adresse::class);
        return $adresseRepository->getApiAddresse($id);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return  $resourceClass === Adresse::class;
    }
}
