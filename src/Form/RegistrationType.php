<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrationType extends ApplicationType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, $this->getConfiguration("Prenom", "Votre prénom..."))
            ->add('lastname', TextType::class, $this->getConfiguration("Nom", "Votre nom..."))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "camilo@gmail.com"))
            ->add('picture', UrlType::class, $this->getConfiguration("Photo de profil", "Ajouter une photo"))
            ->add('hash', PasswordType::class, $this->getConfiguration("Mot de passe", "Choisir un bon mot de passe!"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation mot de passe", "Veuillez confirmer votre mot de passe"))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Présentez-vous en quelques mots..."))
            ->add('description', TextareaType::class, $this->getConfiguration("Description", "C'est le moment de vous présenter en détails !"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
