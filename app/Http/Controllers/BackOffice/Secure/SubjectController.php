<?php

namespace App\Http\Controllers\BackOffice\Secure;

use App\Http\Controllers\Controller;
use App\Subject;
use App\SubjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as File;

class SubjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web-admin');
    }

    public function index() {
        $subjects = Subject::with('category')->with('tags')->get();
        return view('back_office.secure.subject.home')->with('subjects', $subjects);
    }

    public function create () {
        $categories = SubjectCategory::all();
        return view('back_office.secure.subject.add')->with('categories', $categories);
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required|unique:subjects',
            'ar_name' => 'required|unique:subjects',
            'file' => 'required|mimes:png|max:2048',
            'category' => 'required|not_in:0',
        ]);

        $fileName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads/subjects'), $fileName);
        $tags = explode(',', $request->subject_tags);

        $subject = new Subject;

        $subject->name = $request->name;
        $subject->ar_name = $request->ar_name;
        $subject->icon_url = $fileName;
        $subject->category_id = $request->category;

        $subject->save();

        $subject->tag($tags);


        return redirect()->route('back.secure.subject.home')->with('success', 'Subject added succefully');
    }

    public function destroy($id) {
        $subject = Subject::find($id);
        File::delete('uploads/subjects/' . $subject->icon_url);
        $subject->delete();
        return back()->with('success','Subject successfully deleted.');
    }

    public function storeCategory(Request $request) {
        $request->validate([
            'name' => 'required|unique:subject_categories',
            'ar_name' => 'required|unique:subject_categories',
        ]);

        $category = new SubjectCategory();
        $category->name = $request->name;
        $category->ar_name = $request->ar_name;

        $category->save();
        return back()->with('success','Category successfully added.');
    }

    public function storeTags(Request $request) {
        $request->validate([
            'subject_tags' => 'required',
        ]);
        $tags = explode(',', $request->subject_tags);

        $subject = Subject::find($request->subject_id);

        $subject->tag($tags);

        return back()->with('success','Tags successfully added.');
    }
}
