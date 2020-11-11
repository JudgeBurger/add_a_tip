<?php

namespace App\Form;

use App\Entity\Language;
use App\Entity\Tips;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TipsType extends AbstractType
{
    const LANGUAGES = [
        'PHP' => 'PHP',
        'Javascript' => 'Javascript',
        'Java' => 'Java',
        'Python' => 'Python',
        'C' => 'C',
        'C++' => 'C++',
        'C#' => 'C#',
        'Ruby' => 'Ruby',
        'HTML/CSS' => 'HTML/CSS',
        'Typescript' => 'Typescript',
        'MySQL' => 'MySQL',
        'Postregre SQL' => 'Postregre SQL',
        'Microsoft SQL Server' => 'Microsoft SQL Server',
        'SQLite' => 'SQLite',
        'MongoDB' => 'MongoDB',
        'Redis' => 'Redis',
        'MariaBD' => 'MariaBD',
        'Oracle' => 'Oracle',
        'Elasticsearch' => 'Elasticsearch',
        'Firebase' => 'Firebase',
        'jQuery' => 'jQuery',
        'Angular/Angular.js' => 'Angular/Angular.js',
        'React.js' => 'React.js',
        'ASP.NET' => 'ASP.NET',
    ];

    const OS = [
        'Windows' => 'Windows',
        'Linux' => 'Linux',
        'MacOS' => 'MacOS',
    ];

    const FRAMEWORKS = [
        'Express' => 'Express',
        'Spring' => 'Spring',
        'Vue.JS' => 'Vue.JS',
        'Django' => 'Django',
        'Laravel' => 'Laravel',
        'Symfony' => 'Symfony',
        'Flask' => 'Flask',
        'Drupal' => 'Drupal',
    ];

    const DISTRIBUTION_LINUX = [
        'Ubuntu' => 'Ubuntu',
        'Linux Mint' => 'Linux Mint',
        'Debian' => 'Debian',
        'Mageia' => 'Mageia',
        'openSUSE' => 'openSUSE',
        'Fedora' => 'Fedora',
    ];

    const OTHERS = [
        'Git' => 'Git',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('picture')
//            ->add('languages', EntityType::class, [
//                'class' => Language::class,
//                'placeholder' => 'Languages',
//            ])
            ->add('code', TextareaType::class, [
                'attr' => [
                    'rows' => '2',
                ],
            ])
            ->add('languages', ChoiceType::class, [
                'placeholder' => 'Choisissez un langage',
                'choices' => [
                    'Langages' => self::LANGUAGES,
                    'Système D\'exploitation' => self::OS,
                    'Framework' => self::FRAMEWORKS,
                    'Distribution Linux' => self::DISTRIBUTION_LINUX,
                    'Autres' => self::OTHERS,
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
