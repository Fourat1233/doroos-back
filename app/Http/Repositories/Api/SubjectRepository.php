<?php


namespace App\Http\Repositories\Api;

use App\Instructor;
use App\Subject;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class SubjectRepository
{
    /**
     * @var Subject
     */
    private $subject;

    /**
     * @var Instructor
     */
    private $instructor;


    public function __construct(Subject $subject, Instructor $instructor)
    {
        $this->subject = $subject;
        $this->instructor = $instructor;
    }

    /**
     * Return an array of subjects formatted by id (key) and name (value)
     * @return array array of id and name of existing subjects
     */
    public function subjectsList(): Paginator
    {
        return $this->subject
            ->newQuery()
            ->select('id', 'name', 'ar_name', 'icon_url', 'category_id')
            ->with('category:id,name,ar_name')
            ->orderBy('name', 'desc')
            ->paginate(10);
    }


    public function latestSubjects(): Collection
    {
        return $this->subject
            ->newQuery()
            ->select(['id', 'name', 'ar_name', 'icon_url'])
            ->take(5)
            ->get();
    }

    public function findTeachersBySubject(int $subjectId): Paginator
    {
        return $this->instructor
            ->newQuery()
            ->trusted()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->with('subjects:name,ar_name')
            ->select('instructors.*', 'full_name', 'gender', 'phone_cell')
            ->distinct('instructor_subject.instructor_id')
            ->where('users.userable_type', '=', Instructor::class)
            ->whereHas('subjects', function (Builder $query) use ($subjectId) {
                $query->where('id', $subjectId);
            })
            ->paginate(10);
    }
}
