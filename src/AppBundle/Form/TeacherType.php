<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, array(
                'label' => 'Prénom'
            ))
            ->add('lastName', null, array(
                'label' => 'Nom'
            ))
            ->add('cin')
            ->add('tel', null, array(
                'label' => 'Téléphone'
            ))
            ->add('email', null, array(
                'label' => 'Email'
            ))
            ->add('address', null, array(
                'label' => 'Adresse'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Teacher'
        ));
    }
}
