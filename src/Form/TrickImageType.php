<?php

namespace App\Form;

use App\Entity\ImageTrick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Select a file',
                    'class' => ' input-upload',
                    'block_name' => 'custom_name']
            ])
            ->add('alt', TextType::class, [
                'label' => 'Alt text:',
                'attr' => [
                    'placeholder' => 'Alternate text for image'
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImageTrick::class,
        ]);
    }
}
