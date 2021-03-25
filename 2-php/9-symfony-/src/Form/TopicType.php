<?php

namespace App\Form;

use App\Entity\Topic;
use App\Service\SlugService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class TopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du sujet',
                'attr' => [
                    'class' => 'classduchamp',
                    'style' => 'color:red;',
                    'placeholder' => 'Tape le nom du fil'
                ]
            ])
            /*
             * oneToMany / ManyToMany : 1 - association avec des entités existantes
             */
                /*
            ->add('tags', null, [
                'choice_label' => 'text',
                'by_reference' => false
            ])
                */

            /*
             * oneToMany / ManyToMany : 2 - création avec d'entités (formulaires imbriqués) : JAVASCRIPT
             */
            ->add('tags', CollectionType::class, [
                'allow_add' => true,
                'entry_type' => TagType::class,
                //'prototype' => true,
                'label' => false,
                'by_reference' => false
                //'constraints' => [new Count(['min' => 1])]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Topic::class,
        ]);
    }
}
