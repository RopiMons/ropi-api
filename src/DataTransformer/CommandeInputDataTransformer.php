<?php


namespace App\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\DTO\CommandeInput;
use App\Entity\Article;
use App\Entity\ArticleCommande;
use App\Entity\Commande;
use App\Entity\Commerce;
use App\Entity\Contact;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use JsonSchema\Exception\ValidationException;

class CommandeInputDataTransformer implements DataTransformerInterface
{

    private ManagerRegistry $manager;
    private ValidatorInterface $validator;

    public function __construct(ManagerRegistry $manager, ValidatorInterface $validator)
    {

        $this->manager = $manager;
        $this->validator = $validator;
    }

    /**
     * @param CommandeInput $object
     * @param string $to
     * @param array $context
     * @return Commande|void
     */
    public function transform($object, string $to, array $context = [])
    {
        try {

            $this->validator->validate($object);

            $personne = $this->manager->getRepository(Personne::class)->findOneBy([
                'id' => $object->personne,
                'actif' => true
            ]);

            if ($personne === null || !$personne instanceof Personne) {
                return;
            }

            $preferedContact = $this->manager->getRepository(Contact::class)->getMailOf($object->personne, $object->contact);

            if ($preferedContact === null || !$preferedContact instanceof Contact) {
                return;
            }

            $commande = new Commande();

            if (is_array($object->articles) && !empty($object->articles)) {
                foreach ($object->articles as $articleId => $quantite) {
                    $articleId = (int)$articleId;
                    $quantite = (int)$quantite;

                    if (is_int($quantite) && $quantite > 0 && is_int($articleId) && $articleId > 0) {
                        $article = $this->manager->getRepository(Article::class)->findOneBy([
                            'id' => $articleId,
                            'actif' => true
                        ]);
                        if ($article && $article instanceof Article) {
                            $articleCommande = new ArticleCommande();
                            $articleCommande->setCommande($commande);
                            $articleCommande->setArticle($article);
                            $articleCommande->setQuantite($quantite);

                            $commande->addArticlesQuantite($articleCommande);
                        }
                    }
                }
            }

            $commande->setPersonne($personne);
            $commande->setPreferedMail($preferedContact);

            if (!empty($object->depot)) {
                $depot = $this->manager->getRepository(Commerce::class)->findOneBy([
                    'id' => $object->depot,
                    'isComptoir' => true,
                    'visible' => true
                ]);

                if ($depot && $depot instanceof Commerce) {
                    $commande->setPointDepot($depot);
                }
            }

            return $commande;

        } catch (ValidationException $exception) {
            return;
        }

    }

    /**
     * @param array|object $data
     * @param string $to
     * @param array $context
     * @return bool
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a commande we transformed the data already
        if ($data instanceof Commande) {
            return false;
        }

        return Commande::class === $to && null !== ($context['input']['class'] ?? null);
    }
}
