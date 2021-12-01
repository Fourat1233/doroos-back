<?php

namespace App\Http\Controllers\BackOffice\Secure;

use App\Http\Controllers\Controller;
use App\Instructor;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;

class TeacherController extends Controller
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

        $instructors = User::whereHasMorph(
            'userable',
            [Instructor::class]
            )->with(['userable' => function (MorphTo $morphTo) {
            $morphTo->morphWith([
                Instructor::class => ['subjects'],
            ]);
        }])->paginate(10);
        return view('back_office.secure.teacher.home')->with('teachers', $instructors);
    }

    public function show($id)
    {
        $teacher = Instructor::with(['user', 'subjects:id,name'])->findOrFail($id);
        return view('back_office.secure.teacher.profile')->with('teacher', $teacher);
    }

    public function search(Request $request) {
        if($request->ajax())
        {
            $query = $request->get('query');
            $instructorsQuery= User::whereHasMorph(
                'userable',
            [Instructor::class]
                )->with(['userable' => function (MorphTo $morphTo) {
                $morphTo->morphWith([
                    Instructor::class => ['subjects'],
                ]);
            }]);
            if($query){
                $instructorsQuery->where('full_name', 'LIKE', "%{$query}%")
                    ->orWhere('contact_point', 'LIKE', "%{$query}%")
                    ->where('userable_type', '=', Instructor::class);
            }
        }

        return view('back_office.secure.teacher.pagination_data')
            ->with('teachers', $instructorsQuery ->paginate(10))
            ->render();
    }

    public function validation($id) {
        Instructor::where('id', $id)->update(['is_trusted'=> 1]);
        return back()->with('success','Account validated successfully.');
    }
    
    public function review(Request $request) {
            
    }
}
