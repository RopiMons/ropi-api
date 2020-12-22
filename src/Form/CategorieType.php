<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null,[
                'label' => 'Nom de la nouvelles catégorie'
            ])
            //->add('position')
            ->add('faIcone',null,[
                'label' => 'Code Font Awesone de l\'icône représantant la catégorie'
            ])
            ->add('parent',EntityType::class,[
                'label' => 'Eventuelle catégorie principale (Si création d\'une sous-catégorie)',
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
