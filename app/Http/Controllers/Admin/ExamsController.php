<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamService;
use App\Models\Exam;
use App\Http\Requests\Admin\ExamRequest;
use App\Http\Requests\Admin\ExamQuestionsRequest;
use App\Http\Requests\Admin\ExamAnswersRequest;


class ExamsController extends Controller
{

    /**
     * @var examService
     */
    protected $examService;

    /**
     * PostController Constructor
     *
     * @param ExamService $postService
     *
     */
    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $exams = $this->examService->paginate(15);
      return view('admin.exams.list',compact('exams'));
    }



    public function show(Exam $exam)
    {
      $exam = $exam->load("questions.answers");
      return view('admin.exams.show',compact('exam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Exam $exam)
    {
        return view('admin.exams.form',compact('exam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        return $this->examService->save($request);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('admin.exams.form',compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request,Exam $exam)
    {
        return $this->examService->update($exam,$request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        return $this->examService->destroy($exam);

    }

    public function save_exam_questions(ExamQuestionsRequest $request){
        return $this->examService->add_exam_questions($request);
    }

    public function get_exam_questions($exam_id) {
        return $this->examService->get_exam_questions($exam_id);
    }


    public function save_exam_answers(ExamAnswersRequest $request,Exam $exam) {
        $exam_answers = $this->examService->save_exam_answers($request,$exam);
        $exam = $exam->load("questions.answers");
        return view('admin.exams.show',compact('exam','exam_answers'));
    }
}
