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
            ->add('code')
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => '8',
                ],
            ])
            ->add('picture')
            ->add('languages', EntityType::class, [
                'class' => Language::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Choisissez un language',
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
