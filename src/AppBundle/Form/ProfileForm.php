<?php

namespace AppBundle\Form;

use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('middleName')
            ->add('lastName')
            ->add('prefix', ChoiceType::class, [
                'choices' => array(
                    'Mr' => 'Mr',
                    'Mrs' => 'Mrs',
                    'Ms' => 'Ms.',
                    'Miss' => 'Miss',
                    'Dr' => 'Dr',
                    'Eng' => 'Eng',
                    'Pst' => 'Pst',
                    'Other' => 'Other',
                ),
                'placeholder'=>'Select'
            ])
            ->add('dateOfBirth',DateType::class,[
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
            ])
            ->add('stageName')
            ->add('nationality', ChoiceType::class, array(
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
                'placeholder'=>'Select'
            ))
            ->add('language',ChoiceType::class, array(
                'choices' => array(
                    'English' => 'English',
                    'Swahili' => 'Swahili',
                ),
                'placeholder'=>'Select',
                'required'=>false,
                'label'=>"Preffered Language"
            ))
            ->add('maritalStatus',ChoiceType::class, array(
                'choices' => array(
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Separated' => 'Separated',
                    'Divorced' => 'Divorced',
                    'Widowed' => 'Widowed',
                    'Other' => 'Other',
                ),
                'placeholder'=>'Select'
            ))
            ->add('spouseName')
            ->add('idNumber')
            ->add('itaxPin')
            ->add('countryOfResidence', ChoiceType::class, array(
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
                'placeholder'=>'Select'
            ))

            ->add('gender',ChoiceType::class,array(
                'choices'=>array(
                    'Male'=>'Male',
                    'Female'=>'Female',
                ),
                'choices_as_values' => true,
                'multiple'=>false,
                'expanded'=>true,
                'required' => true,
            ))
            ->add('rights',ChoiceType::class,array(
                'choices'=>array(
                    'Sound Recording'=>'Sound Recording',
                    'Audio Visual - Actor'=>'Audio Visual - Actor',
                    'Audio Visual - Musician'=>'Audio Visual - Musician',
                ),
                'multiple'=>true,
                'label'=>'Rights (Hold CTRL and Click to select multiple)'

            ))
            ->add('physicalAddress')
            ->add('postalAddress')
            ->add('postalCode')
            ->add('city')
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
                'placeholder'=>'Select'
            ))
            ->add('phoneNumber',null,[
                'attr'=>[
                    'placeholder'=>'254720123456'
                ]
            ])
            ->add('altPhoneNumber')
            ->add('faxNumber')
            ->add('emailAddress')
            ->add('website')
            ->add('nameOfPayee')
            ->add('paymentMpesaNumber',null,[
                'required'=>true
                ])
            ->add('accountName')
            ->add('bank',ChoiceType::class, array(
                'choices' => array(
                    'Africa Banking Corporation' => 'Africa Banking Corporation',
                    'Bank of Africa' => 'Bank of Africa',
                    'Bank of Baroda' => 'Bank of Baroda',
                    'Bank of India' => 'Bank of India',
                    'Barclays Bank' => 'Barclays Bank',
                    'CFC Stanbic Bank' => 'CFC Stanbic Bank',
                    'Chase Bank' => 'Chase Bank',
                    'Citibank NA' => 'Citibank NA',
                    'Commercial Bank of Africa' => 'Commercial Bank of Africa',
                    'Consolidated Bank' => 'Consolidated Bank',
                    'Co-operative Bank' => 'Co-operative Bank',
                    'Credit Bank' => 'Credit Bank',
                    'Development Bank' => 'Development Bank',
                    'Diamond Trust Bank' => 'Diamond Trust Bank',
                    'Dubai Bank' => 'Dubai Bank',
                    'Ecobank' => 'Ecobank',
                    'Equitorial Commercial Bank' => 'Equitorial Commercial Bank',
                    'Equity Bank' => 'Equity Bank',
                    'Family Bank' => 'Family Bank',
                    'Fidelity Commercial Bank' => 'Fidelity Commercial Bank',
                    'Fina Bank' => 'Fina Bank',
                    'First Community Bank' => 'First Community Bank',
                    'Giro Commercial Bank' => 'Giro Commercial Bank',
                    'Guardian Bank' => 'Guardian Bank',
                    'Gulf African Bank' => 'Gulf African Bank',
                    'Habib Bank A.G Zurich' => 'Habib Bank A.G Zurich',
                    'Habib Bank' => 'Habib Bank',
                    'Imperial Bank' => 'Imperial Bank',
                    'I&M Bank' => 'I&M Bank',
                    'Jamii Bora Bank' => 'Jamii Bora Bank',
                    'Kenya Commercial Bank' => 'Kenya Commercial Bank',
                    'K-Rep Bank' => 'K-Rep Bank',
                    'Middle East Bank' => 'Middle East Bank',
                    'National Bank of Kenya' => 'National Bank of Kenya',
                    'NIC Bank' => 'NIC Bank',
                    'Oriental Commercial Bank' => 'Oriental Commercial Bank',
                    'Paramount Universal Bank' => 'Paramount Universal Bank',
                    'Prime Bank' => 'Prime Bank',
                    'Standard Chartered Bank' => 'Standard Chartered Bank',
                    'Trans-National Bank' => 'Trans-National Bank',
                    'UBA Kenya Bank' => 'UBA Kenya Bank',
                    'Victoria Commercial Bank' => 'Victoria Commercial Bank',
                    'Housing Finance' => 'Housing Finance',
                ),
                'placeholder'=>'Select'
            ))
            ->add('bankBranch')
            ->add('accountNumber')
            ->add('currency',ChoiceType::class, array(
                'choices' => array(
                    'Kenyan Shilling' => 'Kenyan Shilling',
                    'Euro' => 'Euro',
                    'Pound Sterling' => 'Pound Sterling',
                    'Rand' => 'Rand',
                    'Rwanda Franc' => 'Rwanda Franc',
                    'South Sudanese Pound' => 'South Sudanese Pound',
                    'Tanzania Shilling' => 'Tanzania Shilling',
                    'Uganda Shilling' => 'Uganda Shilling',
                    'US Dollar' => 'US Dollar',
                    'Zambian Kwacha' => 'Zambian Kwacha',
                    'Zimbabwe Dollar' => 'Zimbabwe Dollar',
                    'Liberia' => 'Liberia',
                ),
                'placeholder'=>'Select'
            ))
            ->add('bankAccountType',ChoiceType::class, array(
                'choices' => array(
                    'Current' => 'Current',
                    'Savings' => 'Savings',
                ),
                'placeholder'=>'Select'
            ))
            ->add('bankPostalAddress')
            ->add('iban')
            ->add('swiftBic');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Profile'
        ]);
    }

    public function getName()
    {
        return 'app_bundle_profile_form';
    }
}
