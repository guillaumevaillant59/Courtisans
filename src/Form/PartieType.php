<?php

namespace App\Form;

use App\Entity\Carte;
use App\Entity\DomaineReine;
use App\Entity\Partie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombreJoueurMax')
            ->add('domaineReine', EntityType::class, [
                'class' => DomaineReine::class,
                'choice_label' => 'id',
            ])
            ->add('pioche', EntityType::class, [
                'class' => Carte::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partie::class,
        ]);
    }
}
