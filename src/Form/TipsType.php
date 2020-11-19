<?php

namespace App\Form;

use App\Entity\Language;
use App\Entity\Tips;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TipsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('picture')
            ->add('languages', EntityType::class, [
                'class' => Language::class,
                'placeholder' => 'Choisissez un langage',
                'multiple' => true,
                'group_by' => function ($choice, $key, $value) {
                    return $choice->getLanguageCategory()->getName();
                },
            ])
            ->add('code', TextareaType::class, [
                'attr' => [
                    'rows' => '2',
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => '8',
                    'placeholder' => 'Les fixtures permettent de créer de fausses données pour...',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tips::class,
        ]);
    }
}
