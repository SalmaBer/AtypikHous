<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use AppBundle\Entity\FormValidation;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom',
        // instead of being set onto the object directly,
        // this is read and encoded in the controller
        'constraints' => [
            new NotBlank([
                'message' => 'Please enter a nom',
            ]),
            new Length([
                'min' => 4,
                'minMessage' => 'Your nom should be at least {{ limit }} characters',
                // max length allowed by Symfony for security reasons
                'max' => 26,
            ]),

        ],
    ])
            ->add('surname',TextType::class, [
                'label' => 'Prenom',
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a prenom',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your prenom should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 26,
                    ]),

                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => false,
                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*', // All image types
                        ],
                        'mimeTypesMessage' => 'Please upload a valid Image File',
                    ])
                ],
            ])
            ->add('email')



            ->add('password', PasswordType::class, [
                'label' => 'Mots de passe',
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
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
            ])
            // ->add('plainPassword', RepeatedType::class, array(
            //     'type' => PasswordType::class,
            //     'first_options'  => array('label' => 'Password'),
            //     'second_options' => array('label' => 'Repeat Password'),
            // ))




        ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
