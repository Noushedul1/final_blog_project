@extends('layouts.app')
@section('mainSection')
<!-- Answer section -->
<div class="py-4"></div>
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class=" col-lg-9   mb-5 mb-lg-0">
        <article>

          <h1 class="h2">
              {!! $question->question !!}
          </h1>
          <ul class="card-meta list-inline mt-4">
            <li class="list-inline-item">
              <a href="#" class="card-meta-author">
                  @if ($question->user->photo)
                  <img src="{{ asset('images/usr_photos'.$question->user->photo) }}" alt="">
                  @else
                  <img src="{{ asset('images/usr_photos/user.png') }}" alt="">
                  @endif
                <span>{{ $question->user->name }}</span>
              </a>
            </li>
            <li class="list-inline-item">
              <i class="ti-calendar"></i>{{ date('d m y',strtotime($question->created_at)) }}
            </li>
            <li class="list-inline-item text-primary">
              <i class="ti-bookmark"></i>{{ $question->category->name }}
            </li>
          </ul>

        </article>

      </div>

      <div class="col-lg-9 col-md-12">
        <div class="mb-5 border-top mt-4 pt-5">
          <h3 class="mb-4">Answers</h3>
          @if ($question_answers->count() > 0)
            @foreach ($question_answers as $question_answer)
            <div class="card card-body mt-4">
                <div class="media d-block d-sm-flex">
                <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                    @if (auth()->user()->photo)
                    <img src="{{ asset('images/usr_photos/'.$question_answer->user->photo) }}" class="mr-3 avater" alt="">
                    @else
                    <img src="{{ asset('images/usr_photos/user.png') }}" class="mr-3 avater" alt="">
                    @endif
                </a>
                <div class="media-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                    <span>
                        <a href="#!" class="h4 d-inline-block mb-3">{{ $question_answer->user->name }}</a>
                        <small class="text-black-800 ml-2 font-weight-600">
                            {{ date('d m y',strtotime($question_answer->created_at)) }}
                        </small>
                    </span>
                    @if ($question_answer->user_id == auth()->user()->id)
                    <form action="{{ route('questionAnswerDelete',['id'=>$question_answer->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    @endif
                    {{-- <button class="text-danger border-0 bg-white"> <i class="fas fa-trash"></i> </button> --}}
                    </div>

                    <p>
                        {!! $question_answer->answer !!}
                    </p>
                    <hr class="my-3">
                    <div class="">
                    <i class="far fa-heart"></i>
                    <span class="ml-1">(10)</span>
                    </div>
                </div>
                </div>
            </div>
            @endforeach
          @else
            <p>
                There is not answer
            </p>
          @endif
          {{-- <div class="my-3">
              {{ $question_answers->links('pagination::bootstrap-5') }}
          </div> --}}
        </div>

        <div>
          <h3 class="mb-4 pt-4">Leave an answer</h3>

          <form action="{{ route('question.answer.store',['id'=>$question->id]) }}" method="POST">
              @csrf
            <div class="form-group">
              <textarea class="summernote form-control @error('answer') is-invalid
              @enderror shadow-none" name="answer" rows="7"></textarea>
              @error('answer')
              <span class="text-danger">
                  {{ $message }}
              </span>
              @enderror
            </div>

            <button class="btn btn-primary" type="submit">Submit Answer</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
@push('script_body')
<script>
    $(document).ready(function(){
        $('.summernote').summernote({
            height: 200
        });
    });
    @if (Session::has('answerMsg'))
    toastr.options = {
        'progressBar': true,
        'closeButton': true
    }
    toastr.success("{{ Session::get('answerMsg') }}",'Answer',{timeOut: 1200});
    @endif
    @if (Session::has('questionanswerDelete'))
    toastr.options = {
        'progressBar': true,
        'closeButton': true
    }
    toastr.error("{{ Session::get('questionanswerDelete') }}",'Delete',{titmeOut: 12000});
    @endif
</script>
@endpush
@endsection
