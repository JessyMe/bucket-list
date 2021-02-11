<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Idea;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdeaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                "label" => "Your idea"
                ])
            ->add('description', null, [
                "label" => "Tell us more about it"
            ])
            ->add('author', null, [
                "label" => "Signature"
            ])
            ->add('category', EntityType::class,[
                'class'=>Category::class,
                "choice_label"=> "name",
               // "multiple"=>true,
                //"expanded"=>true,

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Idea::class,
        ]);
    }
}
