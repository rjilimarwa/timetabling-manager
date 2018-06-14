<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Intitulé'
            ))
            ->add('code')
            ->add('duration')
            ->add('nbPerWeek', null, array(
                'label' => 'Nombre par semaine'
            ))
            ->add('groups', EntityType::class, array(
                'label' => 'Groupes',
                'class' => 'AppBundle:GroupL',
                'property_path' => 'groups',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id', 'ASC');
                    },
                )
            )
            ->add('levels', EntityType::class, array(
                'label' => 'Niveaux',
                'class' => 'AppBundle:Level',
                'property_path' => 'levels',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id', 'ASC');
                },
            ))
            ->add('teachers', EntityType::class, array(
                'label' => 'Enseignants',
                'class' => 'AppBundle:Teacher',
                'property_path' => 'teacher',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id', 'ASC');
                },
            ))
            ->add('subjects', EntityType::class, array(
                'label' => 'Matières',
                'class' => 'AppBundle:Subject',
                'property_path' => 'subject',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id', 'ASC');
                },
            ))

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Activity'
        ));
    }
}
