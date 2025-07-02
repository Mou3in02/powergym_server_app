<?php

namespace App\Form;

use App\Entity\SeancePers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;


class SeancePersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id_admin', TextType::class, ['label' => 'ID Client'])
            ->add('first_name', TextType::class, ['label' => 'Nom'])
            ->add('last_name', TextType::class, ['label' => 'Prénom'])
            ->add('price', ChoiceType::class, [
                'label' => 'Prix',
                'choices' => [
                    '7000 TND' => 7000,
                    '5000 TND' => 5000,
                    'Gratuit' => 0,
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('date_time', DateTimeType::class, [
                'label' => 'Date & Heure',
                'widget' => 'single_text',
                'html5' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SeancePers::class,
        ]);
    }
}
