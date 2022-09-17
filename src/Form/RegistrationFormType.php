<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname',TextType::class,[
            'label' => 'Prénom',
            'constraints' => new Length(['min'=>2, 'max'=>20]),
            'attr' => [
            'placeholder' => 'Merci de renseigner votre nom'
            ]
        ])
        ->add('lastname',TextType::class,[   
            'label' => 'Prénom',
            'constraints' => new Length(['min'=>2, 'max'=>20]),
            'attr' => [
            'placeholder' => 'Merci de renseigner votre nom']
            ])
            ->add('email',EmailType::class, [
                'label' => 'Email',
                'constraints' => new Length(['min'=>2, 'max'=>60]),
                'attr' => [
                'placeholder' => 'Merci de renseigner votre Email']
            ])
            ->add('Password',RepeatedType::class, [  
                'type' => PasswordType::class,
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => 
                    [
                        'placeholder' => 'Mot de passe']
                    ],
    
                'second_options'=> [
                    'label' => 'Confirmation de Mot de passe',
                    'attr'=> 
                    [
                        'placeholder' => 'Confirmation mot de passe']
                    ]
            ])
            
            ->add('submit',SubmitType::class,[
                'label' => "S'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
