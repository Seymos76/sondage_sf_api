<?php

namespace App\Survey\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SurveyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'familiar_with_energy',
                RadioType::class,
                []
            )
            ->add(
                'what_did_bring_you_to_energetic',
                TextareaType::class,
                []
            )
            ->add(
                'is_practician',
                RadioType::class,
                []
            )
            ->add(
                'in_which_domains_are_you',
                TextareaType::class,
                []
            )
            ->add(
                'subtiles_perceptions',
                CheckboxType::class,
                []
            )
            ->add(
                'is_interested_by_initiation',
                RadioType::class,
                []
            )
            ->add(
                'why_are_you_interested_by_initiation',
                TextareaType::class,
                []
            )
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}
