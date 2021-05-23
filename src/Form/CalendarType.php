<?php

namespace App\Form;

use App\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Objet du rendez-vous',
            ])
            ->add('startAt', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Heure/Date du début',
                'label_attr' => ['class' => 'datetime-calendar']
            ])
            ->add('endAt', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Heure/Date du fin',
                'label_attr' => ['class' => 'datetime-calendar']
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('allday', CheckboxType::class, [
                'label' => 'Journée entière',
                'required' => false
            ])
            ->add('backgroundColor', ColorType::class, [
                'label' => 'Couleur de fond',
            ])
            ->add('borderColor', ColorType::class, [
                'label' => 'Couleur de la bordure',
            ])
            ->add('textColor', ColorType::class, [
                'label' => 'Couleur du texte',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
