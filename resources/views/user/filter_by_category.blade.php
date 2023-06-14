@extends('layouts.app')
@section('mainSection')
<div class="container">
    <div class="row">
        @foreach ($categories as $posts)
        <div class="col-md-6">
            <article class="card mb-4">
                <div class="post-slider">
                    <img src="{{asset('images/post_thumbnails/'.$posts->thumbnail)}}" class="card-img-top" alt="post-thumb" height="400" width="100">
                </div>
                <div class="card-body">
                    <h3 class="mb-3"><a class="post-title" href="post-elements.html">
                    {{ $posts->title }}
                    </a></h3>
                    <ul class="card-meta list-inline">
                    {{-- <li class="list-inline-item">
                        <a href="author-single.html" class="card-meta-author">
                        <img src="{{asset('usr_assets/images/john-doe.jpg')}}" alt="John Doe">
                        <span>

                        </span>
                        </a>
                    </li> --}}
                    <li class="list-inline-item">
                        <i class="ti-timer"></i>3 Min To Read
                    </li>
                    <li class="list-inline-item">
                        <i class="ti-calendar"></i>{{ date('d m y', strtotime($posts->created_at)) }}
                    </li>
                    <li class="list-inline-item">
                        <ul class="card-meta-tag list-inline">
                        <li class="list-inline-item"><a href="tags.html">{{ $posts->category->name }}</a></li>
                        </ul>
                    </li>
                    </ul>
                    <a href="{{ route('single_post_view',['id'=>$posts->id]) }}" class="btn btn-outline-primary">Read More</a>
                </div>
            </article>
        </div>
        @endforeach
    </div>
</div>
@endsection


