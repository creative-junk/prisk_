<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NextOfKinForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName',null,[
            'label'=>false
        ])
        ->add('lastName',null,[
            'label'=>false
        ])
        ->add('relationship',ChoiceType::class, array(
            'choices' => array(
                'Spouse' => 'Spouse',
                'Child'=>'Child',
                'Parent' => 'Parent',
                'Sibling' => 'Sibling',
                'Nephew' => 'Nephew',
                'Niece' => 'Niece',
                'Cousin' => 'Cousin',
                'Friend' => 'Friend',
                'Collegue' => 'Collegue',
                'Other' => 'Other'
            ),
            'placeholder'=>'Select',
            'label'=>false
        ))
        ->add('idNumber',null,[
            'label'=>false
        ])
        ->add('percent',null,[
            'label'=>false
        ])
        ->add('physicalAddress',null,[
            'label'=>false
        ])
        ->add('postalAddress',null,[
            'label'=>false
        ])
        ->add('postalCode',null,[
            'label'=>false
        ])
        ->add('city',null,[
            'label'=>false
        ])
        ->add('country', ChoiceType::class, array(
            'choices' => array(
                'Kenya' => 'Kenya',
                'Angola' => 'Angola',
                'Burundi' => 'Burundi',
                'Cameroon' => 'Cameroon',
                'Ethiopia' => 'Ethiopia',
                'Ghana' => 'Ghana',
                'Lesotho' => 'Lesotho',
                'Nigeria' => 'Nigeria',
                'Rwanda' => 'Rwanda',
                'Senegal' => 'Senegal',
                'South Africa' => 'South Africa',
                'South Sudan' => 'South Sudan',
                'Tanzania' => 'Tanzania',
                'Uganda' => 'Uganda',
                'Zambia' => 'Zambia',
                'Zibambwe' => 'Zimbabwe',
                'Liberia' => 'Liberia',
            ),
            'label'=>false
        ))
        ->add('phoneNumber',null,[
            'label'=>false
        ])
        ->add('email',EmailType::class,[
            'label'=>false,
            'required'=>false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_next_of_kin_form';
    }
}
