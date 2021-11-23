<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Api\SubjectRepository;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{


     /**
     * @var SubjectRepository
     */
    private $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function loadAll(): JsonResponse {
        $subjects = $this->subjectRepository->subjectsList();
        return response()->json($subjects);
    }

    public function loadTeachersBySubject(int $subjectId): JsonResponse {
        $teachers = $this->subjectRepository->findTeachersBySubject($subjectId);
        return response()->json($teachers);
    }
}
