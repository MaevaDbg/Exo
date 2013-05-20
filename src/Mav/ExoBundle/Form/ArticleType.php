<?php

namespace Mav\ExoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Mav\ExoBundle\Form\CommentType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('excerpt')
            ->add('content')
            ->add('status')
            ->add('categories','entity',array(
                    'class' => 'MavExoBundle:Category',
                    'property' => 'name',
                    'expanded' =>true,
                    'multiple' => true,
                    'by_reference' => false
            ))
            ->add('photo', new PhotoType())
            ->add('comments', 'collection', array(
                    'type' => new CommentType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mav\ExoBundle\Entity\Article'
        ));
    }

    public function getName()
    {
        return 'mav_exobundle_articletype';
    }
}
