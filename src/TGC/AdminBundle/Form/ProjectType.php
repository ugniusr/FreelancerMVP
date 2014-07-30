<?php

namespace TGC\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use TGC\AdminBundle\Form\DataTransformer\UserToIntTransformer;


class ProjectType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $UserTransformer = new UserToIntTransformer($options["em"]);
        $builder
            // ->add('title')
            // ->add('startdate')
            // ->add('description')
            // ->add('registrationtimestamp')
            // ->add('status')
            // ->add('userid')
            ->add('title', 'text', array(
                'label' => 'Project title:',
                ))
            ->add('sector', null, array(
                'empty_value' => 'Please select sector',
                'required'    => true
            ))
            ->add('description', 'textarea', array(
                'label' => 'Description & Requirements:',
                ))
            ->add('currency', 'choice', array(
                'choices'   => array(
                    'GBP'=>'GBP',
                    'USD'=>'USD',
                    'EUR'=>'EUR'
                ),
                'required'    => true,
                'empty_data'  => null,
            ))
            ->add('budget', null, array(
                'label' => 'Indicative budget',
                ))
            ->add('duration', null, array(
                'label' => 'Duration (in days, 8hrs/day)',
                ))
            
            ->add('startdate', 'date', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label' => 'Consultant to start work on:'
                )
            )
            ->add('deadline', 'date', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'label'  => 'Project to be completed by:'
                )
            )
            ->add($builder->create('userid', 'hidden')->addModelTransformer($UserTransformer))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TGC\AdminBundle\Entity\Project'
        ));
        $resolver->setRequired(array(
            'em',
        ));
        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tgc_adminbundle_project';
    }
}
