<?php


namespace App\Http\Repositories\Api;

use App\Instructor;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class TeacherRepository
{
    /**
     * @var Instructor
     */
    private $teacher;

    /**
     * @var User
     */
    private $user;

    public function __construct(Instructor $teacher, User $user)
    {
        $this->teacher = $teacher;
        $this->user = $user;
    }

    public function latestTeachers(): Collection
    {

        $teachers = $this->teacher->newQuery()
            ->trusted()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->with('subjects:id,name')
            ->select('profile_image', 'full_name', 'gender', 'users.id as user_id', 'instructors.id as teacher_id')
            ->distinct('instructor_subject.instructor_id')
            ->where('users.userable_type', '=', Instructor::class)
            ->take(5);

        return $teachers->get();
    }

    public function teachersList(): Paginator
    {

        $teachers = $this->teacher->newQuery()
            ->trusted()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->with('subjects:name,ar_name')
            ->select('profile_image', 'full_name', 'gender', 'users.id as user_id', 'instructors.id', 'phone_cell')
            ->distinct('instructor_subject.instructor_id')
            ->where('users.userable_type', '=', Instructor::class);

        return $teachers->paginate(5);
    }


    /**
     * @param integer id
     * @return Instructor
     */
    public function findOne(int $id): Instructor
    {
        return $this->teacher->newQuery()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->with(['subjects' => function ($query) {
                $query->select('name');
            }])
            ->select('instructors.*', 'full_name', 'gender', 'users.id as user_id')
            ->distinct('instructor_subject.instructor_id')
            ->where('users.userable_type', '=', Instructor::class)
            ->firstWhere('instructors.id', $id);
    }

    /**
     * @return integer[]
     */
    public function findMinMax(): array
    {
        $results = $this->teacher->newQuery()
            ->selectRaw('MIN(pricing) as min, MAX(pricing) as max')
            ->first()
            ->toArray();
        return [$results['min'], $results['max']];
    }


    public function findAllAreas(): Collection
    {
        return $this->teacher->newQuery()
            ->trusted()
            ->select('teaching_areas')
            ->get();
    }
}
