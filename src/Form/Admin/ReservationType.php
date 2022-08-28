<?php

namespace App\Form\Admin;

use App\Entity\Admin\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userid', TextType::class, [
                'label' => 'ID Utilisateur',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('hotelid', TextType::class, [
                'label' => 'ID Habitat',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('roomid', TextType::class, [
                'label' => 'Id Chambre',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('surname', TextType::class, [
                'label' => 'Prénom',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('phone', TextType::class, [
                'label' => 'N Telephone',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('checkin',DateType::class,[
                'label' => 'Entrée',
                'row_attr' => [
                    'class' => 'input-group',
                ]
            ])
            ->add('checkout', DateType::class, [

                'label' => 'Sortie',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('days', TextType::class, [
                'label' => 'Jours',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('total', TextType::class, [
                'label' => 'Total',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('message', TextType::class, [
                'label' => 'Message',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('note', TextType::class, [
                'label' => 'Note',
                'row_attr' => [
                    'class' => 'input-group',
                ]])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'row_attr' => [
                    'class' => 'input-group',
                ],
                'choices' => [
                    'En attend' => 'New',
                    'Accepter' => 'Accepted',
                    'Annuler' => 'Cancelled',
                    'Completer' => 'Completed'],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
