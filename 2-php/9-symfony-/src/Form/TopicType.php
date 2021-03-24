<?php

namespace App\Form;

use App\Entity\Topic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
             * oneToMany / ManyToMany : association avec des entités existantes
             */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Topic::class,
        ]);
    }
}
