<?php

namespace App\Form;

use App\Entity\LivraisonSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivraisonSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idDelivery', IntegerType::class, [
                'required' => false,
                'label' => false,
                'atr' => [
                    'placeholder' => 'idDelivery'
                ]
                ])
            ->add('DeliveryGuy', IntegerType::class, [
                'required' => false,
                'label' => false,
                'atr' => [
                    'placeholder' => 'DeliveryGuy'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LivraisonSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
