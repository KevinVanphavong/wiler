<?php

namespace App\Form;

use App\Entity\Comment;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => ['class' => 'input']
            ])
            ->add('note', ChoiceType::class, [
                'choices' => [
                    '1 ⭐' => 1,
                    '2 ⭐⭐' => 2,
                    '3 ⭐⭐⭐' => 3,
                    '4 ⭐⭐⭐⭐' => 4,
                    '5 ⭐⭐⭐⭐⭐' => 5,
                ],
                'attr' => ['class' => 'text-primary input', 'style' => 'font-family: Baskerville'],
                'label' => 'Votre appréciation'
            ])
            // ->add('wilfer')
            // ->add('author')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
