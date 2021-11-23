<?php

namespace App\Http\Controllers\FrontOffice\Guest;

use App\Http\Controllers\Controller;
use App\Http\Repositories\TeacherRepository;
use App\Instructor;
use App\User;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class TeacherController extends Controller
{

    /**
     * @var TeacherRepository
     */
    private $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }


    public function index(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\SearchFilterForm::class, [
            'method' => 'POST',
            'url' => route('front.teachers', ['language' => 'en']),
            'class' => 'js-filter-form'
        ]);

        [$min, $max] = $this->teacherRepository->findMinMax();

        $teachers = $this->teacherRepository->findSearch($form);

        if ($request->isXmlHttpRequest() && (int)$request->get('ajax') === 1) {
            return response()->json([
                'content' => view('front_office.guest.teachers.includes._list', compact('teachers'))->render(),
                'sorting' => view('front_office.guest.teachers.includes._sorting', compact('teachers'))->render(),
                'pagination' => view('front_office.guest.teachers.includes._pagination', compact('teachers'))->render()
            ]);
        }

        return view('front_office.guest.teachers.index', compact('form', 'teachers', 'min', 'max'));
    }

    public function loadOne($lang, int $id)
    {
        if ($id) {
            $instructor = $this->teacherRepository->findOne($id);
            return view('front_office.guest.teachers.details', compact('instructor'));
        }
        return redirect(app()->getLocale() . '/teachers');
    }
}
