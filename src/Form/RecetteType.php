<?php

namespace App\Form;

use App\Entity\Recette;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('abstract')
            ->add('preparation')
            ->add('time')
            ->add('person')
            // ->add('image')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('imageFile', FileType::class)
            // ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
