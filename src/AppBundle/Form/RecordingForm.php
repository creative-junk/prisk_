<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecordingForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isrc',null,[
                'label' => false
            ])
            ->add('skizaId',null,[
                'label' => false
            ])
            ->add('recordingTitle',null,[
                'label' => false
            ])
            ->add('mainArtistCountry', ChoiceType::class, array(
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
                'required' => false,
                'label' => false
            ))
            ->add('featuredArtist',null,[
                'label' => false
            ])
            ->add('genre', null, [
                'attr' => ['placeholder' => 'local'],
                'label' => false
            ])
            ->add('language', ChoiceType::class, array(
                'choices' => array(
                    'Amharic' => 'Amharic',
                    'Arabic' => 'Arabic',
                    'Borana' => 'Borana',
                    'Dholuo' => 'Dholuo',
                    'Digo' => 'Digo',
                    'Embu' => 'Embu',
                    'French' => 'French',
                    'Giriama' => 'Giriama',
                    'Gujarati' => 'Gujarati',
                    'Hindi' => 'Hindi',
                    'Kamba' => 'Kamba',
                    'Kalenjin' => 'Kalenjin',
                    'Kikuyu' => 'Kikuyu',
                    'Kisii' => 'Kisii',
                    'Luhya' => 'Luhya',
                    'Masai' => 'Masai',
                    'Meru' => 'Meru',
                    'Orma' => 'Orma',
                    'Rendile' => 'Rendile',
                    'Swahili' => 'Swahili',
                    'Turkana' => 'Turkana',
                    'Chinese' => 'Chinese',
                    'Kinyarwanda' => 'Kinyarwanda',
                    'Somali' => 'Somali',
                    'Sudanese' => 'Sudanese',
                ),
                'required' => false,
                'label' => false
            ))
            ->add('countryOfRecording', ChoiceType::class, array(
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
                'required' => false,
                'label' => false
            ))
            ->add('countryFirstPublished', ChoiceType::class, array(
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
                'required' => false,
                'label' => false
            ))
            ->add('typeOfRecording', ChoiceType::class, [
                'choices' => array(
                    'Sound Recording' => 'Sound Recording',
                    'Audio Visual Work' => 'Audio Visual Work',
                ),
                'required' => false,
                'label' => false
            ])
            ->add('avWork', ChoiceType::class, [
                'choices' => array(
                    'Not Applicable' => 'Not Applicable',
                    'Film' => 'Film',
                    'Series' => 'Series',
                    'Sitcom' => 'Sitcom',
                    'Music Video' => 'Music Video',
                ),
                'required' => false,
                'label' => false
            ])
            ->add('duration', null, [
                'attr' => ['placeholder' => '00:04:00'],
                'label' => false
            ])
            ->add('dateOfPublication', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
                'label' => false
            ])
            ->add('recordingStudio1',null,[
                'label' => false
            ])
            ->add('recordingStudio2',null,[
                'label' => false
            ])
            ->add('comment',null,[
                'label' => false
            ])
            ->add('albumTitle',null,[
                'label' => false
            ])
            ->add('albumType', ChoiceType::class, [
                'choices' => array(
                    'CD' => 'CD',
                    'LP' => 'LP',
                    'MP3' => 'MP3',
                ),
                'required' => false,
                'label' => false
            ])
            ->add('recordLabel', ChoiceType::class, [
                'choices' => array(
                    'CD' => 'CD',
                    'LP' => 'LP',
                    'MP3' => 'MP3',
                ),
                'required' => false,
                'label' => false
            ])
            ->add('countryOfPublication', ChoiceType::class, array(
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
                'required' => false,
                'label' => false
            ))
            ->add('barCode',null,[
                'label' => false
            ])
            ->add('catalogueNr',null,[
                'label' => false
            ])
            ->add('dateOfFirstRelease', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
                'label' => false
            ])
            ->add('trackTitle')
            ->add('trackNr', null, [
                'attr' => ['placeholder' => '1'],
                'label' => false
            ])
            ->add('sideNr', null, [
                'attr' => ['placeholder' => '1'],
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Recording'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_recording_form';
    }
}
