<?php


namespace App\Http\Repositories;

use App\Forms\SearchFilterForm;
use App\Instructor;
use App\User;
use Illuminate\Database\Eloquent\Builder;
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

    public function findSearch(SearchFilterForm $form): Paginator
    {

        $teachers = $this->teacher->newQuery()
            ->trusted()
            ->join('users', 'users.userable_id', '=', 'instructors.id')
            ->join('instructor_subject', 'instructors.id', '=', 'instructor_subject.instructor_id')
            ->with('subjects:name,ar_name')
            ->select('instructors.*', 'full_name', 'gender')
            ->distinct('instructor_subject.instructor_id')
            ->where('users.userable_type', '=', Instructor::class);

        [
            'q' => $q, 'subjects' => $subjects,
            'gender' => $gender, 'min' => $min,
            'max' => $max
        ] = $form->getFieldValues();

        if (!is_null($q) && !empty($q)) {
            $teachers->where('users.full_name', 'LIKE', "%{$q}%");
        }

        if (!is_null($subjects) && $subjects) {
            if (is_array($subjects)) {
                $teachers->whereHas('subjects', function (Builder $query) use ($subjects) {
                    $query->whereIn('id', $subjects);
                });
            } else {
                $teachers->whereHas('subjects', function (Builder $query) use ($subjects) {
                    $query->where('id', $subjects);
                });
            }
        }

        if (!is_null($gender)) {
            $genderArray = [0 => 'All', 1 => 'Male', 2 => 'Female'];
            if ($genderArray[$gender] !== 'All') {
                $teachers->where('users.gender', '=', $genderArray[(int)$gender]);
            }
        }

        if (!is_null($min) && !empty($min)) {
            $teachers->where('pricing', '>=', $min);
        }

        if (!is_null($max) && !empty($max)) {
            $teachers->where('pricing', '<=', $max);
        }

        return $teachers->paginate(9);
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
     * Rate the user
     * @param integer id
     * @return float
     */

    public function rate(int $id, int $rating) {
        return $this->user->newQuery()
            ->findOrFail($id)
            ->rate($rating);
    }

    /**
     * Get average rating of the user
     * @param integer id
     * @return float
     */

    public function rating(int $id) {
        return $this->user->newQuery()
            ->findOrFail($id)
            ->averageRating;
    }
}
