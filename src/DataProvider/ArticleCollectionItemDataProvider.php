<?php


namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;

class ArticleCollectionItemDataProvider implements CollectionDataProviderInterface, ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{

    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        if (!$this->supports($resourceClass)) {
            throw new ResourceClassNotSupportedException();
        }

        return $this->managerRegistry->getRepository(Article::class)->findBy([
            "actif" => true
        ]);

    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Article::class === $resourceClass;
    }
}
