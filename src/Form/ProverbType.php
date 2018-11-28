<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Proverb;
use App\Entity\Topic;
use App\Entity\Country;

class ProverbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('body')
          ->add('popularity')
          ->add('topic', EntityType::class, array(
            'class' => Topic::class,
            'choice_label' => 'name',
            'multiple' => true
          ))
          ->add('country', EntityType::class, array(
            'class' => Country::class,
            'choice_label' => 'name'
          ))
          ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proverb::class,
        ]);
    }
}
