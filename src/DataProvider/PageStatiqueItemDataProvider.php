<?php


namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Page;
use App\Entity\PageStatique;
use App\Repository\PageStatiqueRepository;
use Doctrine\Persistence\ManagerRegistry;

class PageStatiqueItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
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
        /** @var PageStatiqueRepository $commerceRepository */
        $commerceRepository = $this->managerRegistry->getRepository(PageStatique::class);
        return $commerceRepository->getCompletePage($id);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === PageStatique::class;
    }
}
