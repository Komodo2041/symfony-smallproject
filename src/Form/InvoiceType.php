<?php
 
namespace App\Form;

use App\Entity\Invoice;
use App\Entity\Contractor; 

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
 
 

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
 
        $builder
 
            ->add('amount', NumberType::class, [
                'label' => 'Kwota: ',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Podaj kwotę'],
            ]) 
            ->add('status', ChoiceType::class, [
                'label' => 'Status: ',
                'choices' => [
                    'Zapłacono' => '1',
                    'Nie Opłacono' => '0', 
                ],
                'placeholder' => 'Wybierz opcję: ', // Opcjonalny placeholder
            ])
            ->add('contractor_id', EntityType::class, [
                'label' => 'Wybierz kontraktora',
                'class' => Contractor::class,  // Encja źródłowa
                'choice_label' => 'name',    // Pole encji do wyświetlenia (lub closure dla custom)
                'placeholder' => 'Wybierz opcję',  // Opcjonalny placeholder
                'required' => true,
                'query_builder' => function (EntityRepository $er): QueryBuilder {  // Opcjonalne filtrowanie/sortowanie
                    return $er->createQueryBuilder('c')
                        ->where('c.deleted = 0')
                        ->orderBy('c.name', 'ASC');  // Sortuj po nazwie
                },
                'multiple' => false,  // true dla wielokrotnego wyboru
                'expanded' => false,  // true dla radio/checkbox, false dla <select>
            ])            
            ->add('delayed_date', DateType::class, [
                'label' => 'Termin opłacenia: ',
                'widget' => 'single_text', // Format pola: single_text, choice lub text
                'format' => 'yyyy-MM-dd', // Format daty dla single_text
                'required' => true, // Czy pole jest wymagane
            ]);
 
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
