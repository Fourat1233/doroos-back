<?php


namespace App\Http\Repositories;

use App\Subject;
use Illuminate\Database\Eloquent\Collection;

class SubjectRepository
{
    /**
     * @var Subject
     */
    private $subject;


    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    /**
     * Return an array of subjects formatted by id (key) and name (value)
     * @return array array of id and name of existing subjects
     */
    public function loadAllAsArray(): array
    {
        return $this->subject
            ->newQuery()
            ->select('id', 'name')
            ->orderBy('name', 'desc')
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }


    public function latestSubjects(): Collection {
        return $this->subject
        ->newQuery()
        ->select(['id', 'name', 'ar_name', 'icon_url'])
        ->take(5)
        ->get();
    }
}



