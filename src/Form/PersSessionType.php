<?php

namespace App\Form;

use App\Entity\PersSession;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('price', ChoiceType::class, [
                'label' => 'Prix',
                'choices' => [
                    '7000 TND' => 7000,
                    '5000 TND' => 5000,
                    'Gratuit' => 0,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersSession::class,
        ]);
    }
}
