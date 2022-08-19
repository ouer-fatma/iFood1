<?php

namespace App\Form;

use App\Entity\CommandLine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

    $builder->add('quntity', RangeType::class, [
         'attr' => [
          'min' => 1,
          'max' => 50
                ],
        ])
        ->add('user')
            ->add('command')
            ->add('plate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommandLine::class,
        ]);
    }
}
