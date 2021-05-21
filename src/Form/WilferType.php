<?php

namespace App\Form;

use App\Entity\Wilfer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class WilferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'input']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'input']
            ])
            ->add('birthAt', DateType::class, [
                'label' => 'Née le',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'input']
            ])
            ->add('Description', TextType::class, [
                'label' => 'Phrase d\'accroche',
                'attr' => ['class' => 'input']

            ])

            ->add('wilferImages', FileType::class, [
                'multiple' => true,
                'required' => false,
                'mapped' => false,
                'label' => 'Ajouter des images',
                'attr' => ['class' => 'input']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wilfer::class,
        ]);
    }
}
