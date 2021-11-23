<?php

namespace App\Forms;

use App\Http\Repositories\SubjectRepository;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class SearchFilterForm extends Form
{

    /**
     * @var SubjectRepository
     */
    private $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function buildForm()
    {
        $this
            ->add('q', Field::TEXT, [
                'label_show' => false,
                'attr' => ['placeholder' => 'Search']
            ])
            ->add('subjects', 'choice', [
                'choices' => $this->subjectRepository->loadAllAsArray(),
                'label_show' => false,
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'expanded' => true,
                'multiple' => true
            ])
            ->add('min', Field::TEXT, [
                'label_show' => false,
                'attr' => ['placeholder' => 'Min pricing', 'id' => 'min']
            ])
            ->add('max', Field::TEXT, [
                'label_show' => false,
                'attr' => ['placeholder' => 'Max pricing', 'id' => 'max']
            ])
            ->add('gender', 'choice', [
                'choices' => ['0' => 'All', '1' => 'Male', '2' => 'Female'],
                'attr' => ['class' => 'form-control'],
                'label_show' => false,
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'expanded' => true,
                'multiple' => false
            ]);
    }
}
