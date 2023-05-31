<?php

namespace App\Form;

use App\Entity\WeatherResult;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class WeatherFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country', TextType::class, [
                'label' => 'Kraj:',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Wpisz kraj',
                ],
            ])
            ->add('city', TextType::class, [
                'label' => 'Miasto:',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Podaj miasto',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Pobierz temperaturę',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WeatherResult::class,
        ]);
    }
}
