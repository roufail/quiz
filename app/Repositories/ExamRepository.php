<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\Question;
use App\Http\Requests\Admin\ExamQuestionsRequest;
use App\Http\Requests\Admin\ExamAnswersRequest;
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


    public function save($data)
    {
        return $this->exam->create($data);
    }

    
    public function update($exam,$data)
    {
        $this->exam = $exam;
        return $this->exam->update($data);
    }

    public function destroy($exam)
    {
        $this->exam = $exam;
        $this->exam->questions()->delete();
        return $this->exam->delete();
    }


    public function add_exam_questions(ExamQuestionsRequest $request){
        $this->exam = Exam::find($request->exam_id);
        if(!$this->exam){
            return response()->json(["Error" => "This exam not found"]);
        }
        $this->exam->questions()->delete();
        $answers_ar = [];

        foreach ($request->questions as $Qkey => $question_obj) {

            $question = $this->exam->questions()->create(['question' => $question_obj['question'],'true_answer' => $question_obj['true_answer']]);

            foreach ($question_obj["answers"] as $Akey => $answer) {
                $answers_ar[$Akey] = [
                    "question_id" => $question->id,
                    "answer" => $answer["answer"],
                    "right"  => $question_obj['true_answer'] == $answer["answer"] ? true : false,
                ];
            }
            $question->answers()->createMany($answers_ar);
        }

        
    }



    public function get_exam_questions($exam_id){
        $this->exam = Exam::find($exam_id);
        if(!$this->exam){
            return response()->json(["Error" => "This exam not found"]);
        }

        $questions = $this->exam->load("questions.answers");
        return response()->json(["questions" => $questions]);
    }


    public function save_exam_answers(ExamAnswersRequest $request,Exam $exam){
        $answers = $request->validated();
        $answers_arr;

        $questions_ids = array_keys($answers['answers']);
        $questions     = Question::whereIn('id',$questions_ids)->pluck('true_answer','id')->toArray();


        foreach ($answers['answers'] as $key => $answer) {
            $answers_arr[$key] = [
                'exam_id'     =>  $exam->id,
                'question_id' =>  $key,
                'answer'      =>  $answer,
                'right'       =>  $answer == $questions[$key] ? true : false
            ]; 
        }
        $exam->results()->createMany($answers_arr);
        return $answers_arr;

    }



}
