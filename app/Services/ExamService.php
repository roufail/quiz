<?php

namespace App\Services;

use App\Models\Exam;
use App\Repositories\ExamRepository;
use App\Http\Requests\Admin\ExamRequest;
use App\Http\Requests\Admin\ExamQuestionsRequest;
use App\Http\Requests\Admin\ExamAnswersRequest;

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


    public function save(ExamRequest $request)
    {
        $exam = $this->examRepository->save($request->validated());

        if($exam)
            return redirect()->route('admin.exams.edit',$exam->id)->with(['success' => ' تم اضافه الامتحان  بنجاح']);
    
    
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }



    public function update($exam,ExamRequest $request)
    {
        $updated = $this->examRepository->update($exam,$request->validated());
        
        if($updated)
            return redirect()->route('admin.exams.edit',$exam->id)->with(['success' => ' تم تعديل الامتحان  بنجاح']);
    
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }


    public function destroy($exam)
    {
        $destroyed = $this->examRepository->destroy($exam);
        if($destroyed)
            return redirect()->back()->with(['success' => ' تم حذف الامتحان  بنجاح']);
    
        return redirect()->back()->withErrors(['error' => 'حدث خطأ ما يرجي اعاده المحاوله لاحقاً']);
    }


    public function add_exam_questions(ExamQuestionsRequest $request) {
        return $this->examRepository->add_exam_questions($request);
    }

    public function get_exam_questions($exam_id) {
        return $this->examRepository->get_exam_questions($exam_id);
    }

    public function save_exam_answers(ExamAnswersRequest $request,Exam $exam) {
        return $this->examRepository->save_exam_answers($request,$exam);
    }

}
