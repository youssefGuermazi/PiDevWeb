<?php

namespace AnimateurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimateurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cin')->add('nom')->add('prenom')->add('activiter', ChoiceType::class, array('label' => 'Type ',
            'choices' => array(' Musique' => 'Musique',
                'Sport' => 'Sport','Francais' => 'Francais','Anglais' => 'Anglais'),
            'required' => true, 'multiple' => false,))
            ->add('file');
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AnimateurBundle\Entity\Animateur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'animateurbundle_animateur';
    }


}
