<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class DocumentsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('documentName',ChoiceType::class,[
                'choices'=>$options['docChoices'],
                'placeholder'=>'Select',
                'label'=>'Document Type'
            ])
            ->add('documentFile',VichFileType::class,[
            'required'=>true,
            'allow_delete'=>true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Documents',
            'docChoices'=>null
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_documents_form_type';
    }
}
