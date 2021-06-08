<?php

namespace EnfantBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class suiviType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('noteFrancais',IntegerType::class,array('attr' => array('min' => 0,'max'=>20)))
            ->add('noteAnglais',IntegerType::class,array('attr' => array('min' => 0,'max'=>20)))
            ->add('noteInfo',IntegerType::class,array('attr' => array('min' => 0,'max'=>20)))
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('enfant',EntityType::class,
                array(
                    'class'=>'EnfantBundle\Entity\enfant',
                    'choice_label'=>'id',
                    'multiple'=>false));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EnfantBundle\Entity\suivi'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'enfantbundle_suivi';
    }


}
