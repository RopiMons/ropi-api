<?php


namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ItemNotFoundException;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Commerce;
use App\Repository\CommerceRepository;
use App\Security\Voter\CommerceVoter;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class CommerceDataProvider implements ItemDataProviderInterface, CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private ManagerRegistry $managerRegistry;
    private Security $security;

    public function __construct(ManagerRegistry $managerRegistry, Security $security)
    {
        $this->managerRegistry = $managerRegistry;
        $this->security = $security;
    }

    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if(!$this->supports($resourceClass)){
            throw  new ResourceClassNotSupportedException();
        }
        /** @var CommerceRepository $commerceRepository */
        $commerceRepository = $this->managerRegistry->getRepository(Commerce::class);
        /** @var Commerce[] $commerces */
        $commerces = $commerceRepository->getCommerces();

        if(is_array($commerces)) {
            return array_filter($commerces,function(Commerce $commerce){return $this->security->isGranted(CommerceVoter::VIEW,$commerce);});
        }
        throw new ItemNotFoundException();
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if(!$this->supports($resourceClass)){
            throw  new ResourceClassNotSupportedException();
        }
        /** @var CommerceRepository $commerceRepository */
        $commerceRepository = $this->managerRegistry->getRepository(Commerce::class);
        return $commerceRepository->getCommerces($id);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Commerce::class;
    }
}
