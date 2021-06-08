<?php

namespace MedecinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedecinType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cin')
            ->add('specialite', ChoiceType::class, array('label' => 'Type ',
                'choices' => array('Generaliste' => 'Generaliste',
                    'Psychiatre' => 'Psychiatre','Pediatre' => 'Pediatre'),
                'required' => true, 'multiple' => false,))
            ->add('nom')->add('prenom')
            ->add('file');
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MedecinBundle\Entity\Medecin'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'medecinbundle_medecin';
    }


}
