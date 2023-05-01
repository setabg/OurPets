<?php

namespace App\Form;

use App\Entity\AddPets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPetsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Име'
            ])
            ->add('petKind', TextType::class, [
                'label' => 'Вид животно'
            ])
            ->add('petInfo', TextType::class, [
                'label' => 'Информация'
            ])
            ->add('Save', SubmitType::class, [
                'label' => 'Запази',
                'attr'=>[
                    'class'=>'btn btn-success float-right'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddPets::class,
        ]);
    }
}
