<?php

namespace App\Http\Controllers\FrontOffice\Guest;

use App\Http\Controllers\Controller;
use App\Instructor;
use App\Subject;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        $subjects = Subject::all();
        $gender = $request->get('gender');

        $InstructorQuery = Instructor::query()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->where('users.userable_type', '=', Instructor::class)
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->join('subjects', 'subjects.id', '=', 'instructor_subject.subject_id')
            ->select('subjects.name as subject_name', 'instructors.*', 'users.full_name')
            ->orderBy('users.created_at', 'desc');

        if($gender) {
            $teachers = Instructor::query()
                ->join('users', 'users.userable_id', '=', 'instructors.id')
                ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
                ->with(['subjects' => function($query){
                    $query->select('name');
                }])
                ->where('users.userable_type', '=', Instructor::class)
                ->select( 'instructors.*','users.full_name')
                ->distinct('instructor_subject.instructor_id')
                ->where('users.gender', '=', $gender)
                ->paginate(12);
            return view('front_office.guest.search')
                ->with('subjects', $subjects)
                ->with('gender', $gender)
                ->with('teachers', $teachers);
        }

        $InstructorQuery = Instructor::query()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->with(['subjects' => function($query){
                $query->select('name');
            }])
            ->where('users.userable_type', '=', Instructor::class)
            ->select( 'instructors.*','users.full_name')
            ->distinct('instructor_subject.instructor_id');

        $teachers = $InstructorQuery->paginate(12);
         return view('front_office.guest.search')
            ->with('subjects', $subjects)
            ->with('gender', $gender)
             ->with('teachers', $teachers);
    }
}
