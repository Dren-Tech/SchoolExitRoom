<?php

namespace App\Form;

use App\Entity\LearnApp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LearnAppFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('link', UrlType::class, [
                'label' => 'Link zur App',
            ])
            ->add('title', TextType::class, [
                'label' => 'Titel',
            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Schwierigkeit',
                'choices'  => [
                    'leicht' => 'easy',
                    'mittel' => 'middle',
                    'schwierig' => 'hard',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LearnApp::class,
        ]);
    }
}
