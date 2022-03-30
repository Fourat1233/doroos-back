<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Api\LocationRepository;
use App\Http\Repositories\Api\TeacherRepository;
use App\Http\Repositories\SubjectRepository;
use App\Instructor;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{


         /**
     * @var LocationRepository
     */
    private $locationRepository;


    /**
     * @var TeacherRepository
     */
    private $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository,LocationRepository $locationRepository)
    {
        $this->teacherRepository = $teacherRepository;
        $this->locationRepository = $locationRepository;
    }

    public function loadAll()
    {
        $teachers = $this->teacherRepository->teachersList();
        return response()->json($teachers);
    }

    public function pricingMinMax(): JsonResponse
    {
        return response()->json([
            'data' => $this->teacherRepository->findMinMax()
        ]);
    }

    public function search(Request $request)
    {/*
        $q = $request->get('q');
        $subjects = $request->get('subjects') ?? [];

        $teachersQuery = Instructor::whereHas('user', fn ($query) => $query->where('full_name', 'LIKE', "%" . $q . "%"))
            ->select('id');

        if (count($subjects) > 0) {
            dd(1);
            $teachersQuery->whereHas('subjects', fn ($query) => $query->whereIn('id', $subjects));
        }

        return [
            'success' => true,
            'data' => $teachersQuery->count()
        ];

        $InstructorQuery = Instructor::query()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->join('subjects', 'subjects.id', '=', 'instructor_subject.subject_id')
            ->where('users.userable_type', '=', Instructor::class)
            ->select('instructors.id')
            ->orWhere('users.full_name', 'like', '%' . $q . '%');

        return response()->json($InstructorQuery->get());
        */
    }

    public function bySubject($id)
    {
        $InstructorQuery = Instructor::query()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->join('subjects', 'subjects.id', '=', 'instructor_subject.subject_id')
            ->where('users.userable_type', '=', Instructor::class)
            ->select('instructors.*', 'subjects.name as subject_name', 'users.full_name')
            ->where('subjects.id', '=', $id);
        return response()->json($InstructorQuery->get());
    }

    public function getOne($id)
    { /*
        $Instructor = Instructor::query()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->where('users.userable_type', '=', Instructor::class)
            ->where('users.id', '=', $id)
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->with('subjects:name')
            ->select('instructors.*', 'users.full_name as full_name', 'users.id as user_id', 'users.profile_image as profile_image')
            ->first();

        return response()->json([
            'data' => $Instructor
        ]); **/

            if ($id) {
                
                $teacher = Instructor::with(['user', 'subjects:id,name'])->findOrFail($id);
                return response()->json([
                    'data' => $teacher
                ]);
            }
           
        
    }

    public function rate(Request $request, int $id)
    {
        $rating = $request->get('rating');
        return [
            'success' => true,
            'data' => [
                'rating' => $this->teacherRepository->rate($id, $rating)
            ]
        ];
    }

    public function nearby(Request $request)  //require long and lat as parameters
    {
        //getting the list of nearby cities
            $radius = 10 ;
        // return response()->json($locations);
        if ( $request->filled('lng') and $request->filled('lat') ){
            $teachers = $this->teacherRepository->teachersList();
            $nearByTeachers = [];
          //  return $teachers;
            foreach ($teachers as $key => $value) {
            
                if (abs ($value->longitude - $request->lng)<$radius && abs($value->latitude - $request->lat)<$radius){
                    array_push($nearByTeachers,$value);
                }
            }
            return $nearByTeachers;
            
        }
        else 
        return response()->json("Please provide lng and lat params");
    }



}
