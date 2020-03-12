<?php

namespace App\Form;

use App\Entity\Filter\RechercheVoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * Class RechercheVoitureType
 * @package App\Form
*/
class RechercheVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minAnnee', IntegerType::class, [
                'required' => false, // champ pas obligatoire
                'label' => 'Annee de :'
            ])
            ->add('maxAnnee', IntegerType::class, [
                'required' => false, // champ pas obligatorie
                'label' => 'Annee a : '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheVoiture::class,
        ]);
    }
}
