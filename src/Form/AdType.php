<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class AdType extends AbstractType
{

    /**
     * Permet d'avoir la configuration de base d'un champ !
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return [
            'label' => $label,
                'attr' => [
                    'placeholder' => $placeholder
                ]
                ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration('Titre', "Tapez un super titre pour votre annonce !"))
            ->add('slug', TextType::class, $this->getConfiguration('Adresse web', "Adresse web (automatique)"))
            ->add('coverImage', UrlType::class, $this->getConfiguration("URL de l'image principale", "Donnez l'adresse d'une image qui donne vraiment envie"))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction", "Donnez une description globale de l'annonce"))
            ->add('content', TextareaType::class, $this->getConfiguration("Description détaillée", "Tapez une description qui donne vraiment envie de venir chez vous !"))
            ->add('rooms', IntegerType::class, $this->getConfiguration("Nombre de chambres", "Tapez le nombre de chambres"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix par nuit", "Indiquez le prix que vous voulez pour une nuit"))
            ->add('save', SubmitType::class, [
                'label' => 'Créer la nouvelle annonce',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
             // enable/disable CSRF protection for this form
             'csrf_protection' => false,
             // the name of the hidden HTML field that stores the token
             'csrf_field_name' => '_token',
             // an arbitrary string used to generate the value of the token
             // using a different string for each form improves its security
             'csrf_token_id'   => 'task_item',
             'allow_extra_field' => true
        ]);
    }
}

                    
                    