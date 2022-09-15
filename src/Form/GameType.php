<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du jeu',
                'attr' => [
                    'placeholder' => 'Risk, Méditéranée, ...'
                ],
            ])
            ->add('picture')
            ->add('description', null, [
                'attr' => [
                    'rows' => 5,
                ],
            ])
            ->add('minimumAge', RangeType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 18,
                ],
                'label' => 'Age minimum',
            ])
            ->add('minimumPlayer', null, [
                'label' => 'Nombre de joueur minimum',
                'attr' => [
                    'min' => 1,
                    'max' => 100,
                ]
            ])
            ->add('maximumPlayer', null, [
                'label' => 'Nombre de joueur maximum',
                'attr' => [
                    'min' => 1,
                    'max' => 100,
                ]
            ])
            ->add('duration', null, [
                'label' => 'Durée moyenne',
                'hours' => range(0, 6),
                'minutes' => range(0, 55, 5),
                'attr' => [
                    'class' => 'form-aligned',
                ]
            ])
            ->add('releaseAt', null, [
                'widget' => 'single_text',
                'label' => 'Date de sortie',
            ])
            ->add('category', null, [
                'label' => 'Catégorie',
            ])
            ->add('editors', null, [
                'label' => 'Editeurs',
                'choice_label' => 'name',
                'expanded' => true,
                'attr' => [
                    'class' => 'checkbox-list'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
