@extends('admin.template.master.layout')

@section("title",$exam->title)
@section('content')

<div class="card col-md-12">
    <div class="card-header" style="color:white;background-color: #007bff;">
      <h4>{{ $exam->title }}</h4>
    </div>
    <div class="clearfix"></div>
    <ul class="list-group list-group-flush">

    <form method="post" action="{{ route('admin.exams.save_exam_answers',$exam->id) }}">
      @csrf
      @foreach ($exam->questions as $question)
          <li class="list-group-item">
            <h4>{{ $question->question }}</h4>
            <div class="clearfix"></div>
            <ul class="list-group list-group-horizontal">
              @foreach ($question->answers as $answer)
                <li class="list-group-item">
                    <div class="form-check">
                        <input required class="form-check-input" @if(isset($exam_answers[$question->id]) && $answer->answer == $exam_answers[$question->id]['answer']) checked @endif type="radio" name="answers[{{$question->id}}]" id="answer-{{$question->id}}-{{$answer->id}}" value="{{ $answer->answer }}">
                        <label class="form-check-label" for="answer-{{$question->id}}-{{$answer->id}}">
                            {{ $answer->answer }}
                        </label>
                    </div>
                </li>
              @endforeach
            </ul>

            <div class="col-md-12 error text-danger">
              @if (isset($exam_answers[$question->id]) && $exam_answers[$question->id]['right'] != "1")
                <br />Wrong Answer
              @endif      
            </div>



          </li>
      @endforeach
      <li class="list-group-item float-right">
        <button class="btn btn-primary">Save</button>
      </li>
    </ul>
    </form>
  </div>

  
@endsection