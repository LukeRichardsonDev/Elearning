<?php

namespace App\Forms;

use App\Entity\Course;
use App\Forms\ContentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('courseName', TextType::class)
            ->add('description', TextType::class)
            ->add('content', CollectionType::class, [
                'required' => false,
                'entry_type' => ContentType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
//            ->add('materials', TextType::class)
//            ->add('questions', RepeatedType::class, array(
//                'type' => PasswordType::class,
//                'first_options'  => array('label' => 'Password'),
//                'second_options' => array('label' => 'Repeat Password'),
//            ));

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
            'csrf_protection' => false,
        ]);
    }
}
