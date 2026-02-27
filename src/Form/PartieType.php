<?php

namespace App\Form;

use App\Entity\Carte;
use App\Entity\DomaineReine;
use App\Entity\Partie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PartieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombreJoueurMax', ChoiceType::class, [
                'choices' => [
                    '2 joueurs' => 2,
                    '3 joueurs' => 3,
                    '4 joueurs' => 4,
                    '5 joueurs' => 5,
                ],
                'label' => 'Nombre de joueurs',
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
