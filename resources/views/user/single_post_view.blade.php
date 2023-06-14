@extends('layouts.app')
@section('mainSection')
<section class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class=" col-lg-9   mb-5 mb-lg-0">
          <article>
            <div class="post-slider mb-4">
              <img src="{{ asset('images/post_thumbnails/'.$post->thumbnail) }}" class="card-img" alt="post-thumb">
            </div>

            <h1 class="h2">{{ $post->title }}</h1>
            <h4 class="h4">{{ $post->subtitle }}</h4>
            <ul class="card-meta my-3 list-inline">
              <li class="list-inline-item">
                <a href="author-single.html" class="card-meta-author">
                  <img src="images/john-doe.jpg">
                  <span>Charls Xaviar</span>
                </a>
              </li>
              <li class="list-inline-item">
                <i class="ti-timer"></i>2 Min To Read
              </li>
              <li class="list-inline-item">
                <i class="ti-calendar"></i>{{ date('d m y',strtotime($post->created_at)) }}
              </li>
              <li class="list-inline-item">
                <ul class="card-meta-tag list-inline">
                  <li class="list-inline-item"><a href="tags.html">Category: {{ $post->category->name }}</a></li>
                </ul>
              </li>
            </ul>
            <div class="content"><p>
                {!! $post->description !!}
            </p>
            </div>
          </article>

        </div>

        <div class="col-lg-9 col-md-12">
            <div class="mb-5 border-top mt-4 pt-5">
                <h3 class="mb-4">Comments</h3>
                @foreach ($comments as $comment)
                <div class="media d-block d-sm-flex mb-4 pb-4">
                    <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                        @if ($comment->user->photo)
                        <img src="{{ asset('images/usr_photos/'.$comment->user->photo) }}" alt="" class="rounded-circle" height="40" width="40">
                        @else
                        <img src="{{ asset('images/usr_photos/user.png') }}" alt="" class="rounded-circle" height="40" width="40">
                        @endif
                    </a>
                    <div class="media-body">
                        <a href="#!" class="h4 d-inline-block mb-3">
                            {{ $comment->user->name }}
                        </a>

                        <p>
                            {!! $comment->comment !!}
                        </p>

                        <span class="text-black-800 mr-3 font-weight-600">
                            {{ date('d-m-y',strtotime($comment->created_at)) }}
                        </span>
                        @if ($comment->user_id == auth()->user()->id)
                        <form action="{{ route('comment.delete',['id'=>$comment->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endif
                        <a class="text-primary font-weight-600" href="#!">Reply</a>
                    </div>
                </div>
                @endforeach
                {{ $comments->links() }}
            </div>

            <div>
                <h3 class="mb-4">Leave a Reply</h3>
                <form method="POST" action="{{ route('comment_store',['id'=>$post->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <textarea class="summernote form-control shadow-none" name="comment" rows="7" required></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Comment Now</button>
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
    @if (Session::has('postCommentMsg'))
    toastr.options = {
        'progressBar': true,
        'closeButton': true
    }
    toastr.success("{{ Session::get('postCommentMsg') }}",'Comment',{titmeOut:12000});
    @endif
    @if (Session::has('commentDeleteMsg'))
    toastr.options = {
        'progressBar': true,
        'closeButton': true
    }
    toastr.error("{{ Session::get('commentDeleteMsg') }}",'Comment',{titmeOut:12000});
    @endif
</script>
@endpush
@endsection
{{-- @include('layouts.includes.banner') --}}

