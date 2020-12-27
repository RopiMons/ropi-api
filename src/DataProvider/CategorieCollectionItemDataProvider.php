<?php


namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategorieCollectionItemDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface, ItemDataProviderInterface
{
    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Categorie::class;
    }

    public function getCollection(string $resourceClass, string $operationName = null)
    {
        if(!$this->supports($resourceClass)){
            throw new ResourceClassNotSupportedException();
        }

        /** @var CategorieRepository $categorieRepository */
        $categorieRepository = $this->managerRegistry->getRepository(Categorie::class);
        return $categorieRepository->getStructuredMenu();
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        if(!$this->supports($resourceClass)){
            throw new ResourceClassNotSupportedException();
        }
        /** @var CategorieRepository $categorieRepository */
        $categorieRepository = $this->managerRegistry->getRepository(Categorie::class);
        $retour = $categorieRepository->getCategorie($id);
        if(is_array($retour) && key_exists(0,$retour)){
            return $retour[0];
        }else{
            null;
        }

    }
}
