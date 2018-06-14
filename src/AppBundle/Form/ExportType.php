<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('exports', ChoiceType::class, array(
                'label' => 'Selectionner les éléments à exporter',
                'property_path' => 'exports',
                'multiple' => true,
                'expanded' => true,
                'choices' => array(
                    'Enseignants' => 'teacher',
                    'Groupes' => 'groupL',
                    'Niveaux' => 'level',
                    'Classes' => 'room',
                    'Activités' => 'activity',
                    'Matières' => 'subject'
                )
            )
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Form\Model\Export'
        ));
    }
}
