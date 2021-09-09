<?php

namespace App\Services;

use App\Models\Exam;
use App\Repositories\ExamRepository;



class ExamService
{
    /**
     * @var $postRepository
     */
    protected $examRepository;

    /**
     * PostService constructor.
     *
     * @param Exam Repository $examRepository
     */
    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    public function getAll()
    {
        return $this->examRepository->getAll();
    }


    public function paginate($count)
    {
        return $this->examRepository->paginate($count);
    }



}
