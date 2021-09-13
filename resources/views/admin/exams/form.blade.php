@extends('admin.template.master.layout')
@push('extra-css')
<link rel="stylesheet" href="{{ asset('css/datetimepicker.min.css') }}">
@endpush
@section('content')
<div class="col-md-12">
    {{-- @include('admin.template.components.alerts') --}}



    <form role="form" enctype="multipart/form-data"
        action="{{ $exam->id ? route('admin.exams.update',$exam->id) : route('admin.exams.store') }}" method="POST">
        <div class="card-body">
            @csrf
            @if($exam->id)
            @method('put')
            @endif
            <div class="form-row">


                <div class="form-group col-md-12">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{ old_value($exam,'title') }}"
                        class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter the title">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div><!-- form row -->



        </div>
        <!-- /.card-body -->

        @if(!$exam->id)
        <div id="app">
            <exam-questions :id="{{ $exam->id }}"></exam-questions>
        </div>
        @endif
    
        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-left">save</button>
        </div>
    </form>


    @if($exam->id)
    <div id="app">
        <exam-questions :exam_id="{{ $exam->id }}"></exam-questions>
    </div>
    @endif
</div>



@endsection

@push('extra-js')
<script src="{{ asset('admin-assets/js/app.js') }}"></script>
@endpush

