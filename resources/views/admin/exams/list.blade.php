@extends('admin.template.master.layout')


@section('content')
<div class="col-lg-12">

    @include('admin.template.components.alerts')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">exams</h5>

            <div class="card-tools">
                <a href="{{ route('admin.exams.create') }}"><i class="fa fa-plus"></i></a>
            </div>

        </div>
        <div class="card-body">
            @if ($exams->count() > 0)
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>exam</th>
                        <th>choices</th>
                    </tr>
                    @foreach ($exams as $exam)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $exam->title }}
                        </td>



                        <td>



                            <div class="float-left mr-3">
                                <a href="{{ route('admin.exams.edit',$exam->id) }}"><i
                                        class="fa fa-edit"></i>&nbsp;edit</a>
                            </div>


                            <div class="float-left mr-3">
                                <form style="display:inline-flex" method="post"
                                    action="{{ route('admin.exams.destroy',$exam->id) }}">
                                    @csrf
                                    @method('delete')
                                    <a class="delete-btn" href="javascript:;"><i class="fa fa-trash"></i>&nbsp;delete</a>
                                </form>
                            </div>

                            <div class="float-left">
                                <a href="{{ route('admin.exams.show',$exam->id) }}"><i class="fas fa-vial"></i>&nbsp;take exam</a>
                            </div>


                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            @else
            there is no exams
            @endif






        </div><!-- card body -->


        <div class="card-footer clearfix">
            {{ $exams->render('admin.template.components.pagination') }}
        </div>

    </div>
</div>
@endsection




@section('extra-scripts')
<script>
    jQuery(function($){
        $('.delete-btn').click(function(event){
            event.preventDefault();

            Swal.fire({
                title: 'are you sure ?',
                text: "you can't retrive this proccess.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'yes delete it',
                cancelButtonText: 'cancel'
                }).then((result) => {
                if (result.value) {
                    $(this).parent().submit();
                }
                })



        });
      })

</script>
@endsection

@push('extra-js')
<script src="{{ asset('admin-assets/js/sweetalert2.js') }}"></script>
@endpush
