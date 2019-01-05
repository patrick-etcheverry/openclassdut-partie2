<?php

namespace App\Form;

use App\Entity\Ressource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\TypeRessource;
use App\Entity\Module;

class RessourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('descriptif')
            ->add('urlRessource')
            ->add('urlVignette')
            ->add('typeRessource', EntityType::class, array(
                'class' => TypeRessource::class,
                'choice_label' => 'nomType',

                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => true,
            ))
            ->add('modules', EntityType::class, array(
                'class' => Module::class,
                'choice_label' => function(Module $module)
                {return $module->getCode().' '.$module->getTitre();},

                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ressource::class,
        ]);
    }
}
