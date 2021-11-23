<?php

namespace App\Http\Controllers\FrontOffice\Guest;

use App\Http\Controllers\Controller;
use App\Subject;
use App\SubjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index(Request $request) {
        $query = $request->get('search');
        $categoryName = $request->get('category');
        $categories = SubjectCategory::get();
        $subjects = null;

        $subjectsQuery =DB::table('subjects')
            ->join('subject_categories', 'subjects.category_id', '=', 'subject_categories.id')
            ->select('subject_categories.name as category_name', 'subject_categories.ar_name as category_ar_name',  'subjects.*');

        if(!$query && !$categoryName) {
            $subjects = $subjectsQuery->paginate(8);
        }

        if($query) {
            $subjects = $subjectsQuery
                ->where('subjects.name', 'like', '%'.$query.'%')
                ->orWhere('subjects.ar_name', 'like', '%'.$query.'%')
                ->orWhere('subject_categories.name', 'like', '%'.$query.'%')
                ->paginate(8);
        } if($categoryName) {
            if($categoryName === 'all') {
                $subjects = $subjectsQuery->paginate(8);
            } else {
                $subjects= $subjectsQuery
                    ->where('subject_categories.name', 'like', '%'. $categoryName .'%')
                    ->paginate(8);
            }
        }

        return view('front_office.guest.subject.subjects')
            ->with('input', $query)
            ->with('subjects', $subjects)
            ->with('categories', $categories);
    }
}
