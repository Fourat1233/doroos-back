<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Api\SubjectRepository;
use App\Http\Repositories\Api\TeacherRepository;
use App\Instructor;
use App\Subject;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{

     /**
     * @var TeacherRepository
     */
    private $teacherRepository;

     /**
     * @var SubjectRepository
     */
    private $subjectRepository;

    public function __construct(TeacherRepository $teacherRepository, SubjectRepository $subjectRepository)
    {
        $this->teacherRepository = $teacherRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function loadPopular(): JsonResponse
    {
        
        $teachers = $this->teacherRepository->latestTeachers();
        $subjects = $this->subjectRepository->latestSubjects();

        return response()->json([
            'teachers' => $teachers,
            'subjects' => $subjects,
        ]);
    }
}
