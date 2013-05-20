<?php

namespace Mav\ExoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Mav\ExoBundle\Form\PhotoType;

class BreveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('status')
            ->add('photo', new PhotoType())
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mav\ExoBundle\Entity\Breve'
        ));
    }

    public function getName()
    {
        return 'mav_exobundle_brevetype';
    }
}
