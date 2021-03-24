<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\Topic;
use App\Repository\TopicRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')

            /*
             * ManyToOne : 1 - Choix d'une entité existante
             */
            /*
            ->add('topic', EntityType::class, [
                'choice_label' => 'name',
                'class' => Topic::class,

                // Pour limiter les entités sélectionnables : query_builder

                //'query_builder' => function(TopicRepository $topicRepo) {
                //    return $topicRepo->findByNameContainsBuilder("coucou");
                //}
            ])
            ->add('topic')
            */

            /*
             * ManyToOne : 2 - création d'une entité / formulaire imbriqué
             */
            ->add('topic', TopicType::class, [
                'help' => '<i class="fa fa-question-circle" data-toggle="tooltip" title="message coucou"></i>',
                'help_html' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
