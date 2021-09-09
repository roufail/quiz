<?php

namespace App\Repositories;

use App\Models\Exam;

class ExamRepository
{
    /**
     * @var exam
     */
    protected $exam;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
    }

    /**
     * Get all posts.
     *
     * @return Post $post
     */
    public function getAll()
    {
        return $this->exam
            ->get();
    }


    public function paginate($count)
    {
        return $this->exam
            ->paginate($count);
    }



    
}
