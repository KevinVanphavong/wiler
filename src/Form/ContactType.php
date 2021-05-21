<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Entertainement;
use App\Entity\Wilfer;
use DateTime;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['placeholder' => 'John', 'class' => 'input']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Doe', 'class' => 'input']
            ])
            ->add('duration', ChoiceType::class, [
                "choices" => [
                    "1 heure" => "1 heure",
                    "3 heures" => "3 heures",
                    "6 heures" => "6 heures",
                    "9 heures" => "9 heures",
                    "Autres (précisez votre durée souhaité dans l'encadré ci-dessous)" => "Autres",
                ],
                'attr' => ['class' => 'text-primary duration input'],
                'mapped'    => false,
                'label' => "Définir un créneau"
            ])
            ->add('wilfers', EntityType::class, [
                'class' => Wilfer::class,
                'choice_label' => 'fullname',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'mapped'    => false,
                'label' => 'Choisir ses wilfers',
                'attr' => ['class' => 'wilfers-to-select input'],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Johndoe@gmail.com', 'class' => 'input']
            ])
            ->add('events', EntityType::class, [
                'class' => Entertainement::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'by_reference' => false,
                'mapped'    => false,
                'label' => 'Type d\'évènement',
                'attr' => ['class' => 'text-primary reason input'],

            ])
            // ->add('reason', ChoiceType::class, [
            //     'choices' => [
            //         'Fête en famille' => 'Fête en famille',
            //         'Evènements professionnel' => 'Evènements professionnel',
            //         'Peine d\'amour' => 'Peine d\'amour',
            //         'Evènements personnels' => 'Evènements personnels'
            //     ],
            //     'attr' => ['class' => 'text-primary reason'],
            //     'label' => 'Types d\'évènements'
            // ])
            ->add('otherReason', TextareaType::class, [
                'attr' => ['placeholder' => 'Ecrivez votre raison ici', 'class' => 'input'],
                'label' => 'Expliquez nous vos envies'
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
