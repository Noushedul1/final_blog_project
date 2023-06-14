@extends('layouts.app')
@section('mainSection')
<!-- questions section -->
<section class="section-sm">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8  mb-5 mb-lg-0">
          <h2 class="h5 section-title">Questions</h2>

          <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="h5">Frequently asked questions</h5>
              <a href="#askQuestion" class="btn btn-primary">Ask a Question</a>
          </div>

          @foreach ($questions as $question)
          <div class="card mt-4 border">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('question.answers',$question->id) }}" class="btn-link">
                        {!! $question->question !!}
                    </a>
                @if ($question->user_id == auth()->user()->id)
                <form action="{{ route('question.delete',['id'=>$question->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                @endif
                {{-- <button class="text-danger border-0 bg-white">
                    <i class="fas fa-trash"></i> </button> --}}
              </div>

              <ul class="card-meta list-inline mt-4">
                <li class="list-inline-item">
                  <a href="#" class="card-meta-author">
                      @if ($question->user->photo)
                      <img src="{{ asset('images/usr_photos'.$question->user->photo) }}">
                      @else
                      <img src="{{ asset('images/usr_photos/user.png') }}">
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
                <li class="list-inline-item text-primary">
                  <i class="ti-comment"></i>
                  {{ $QuestionAnswer->count() }}
                  @if ($QuestionAnswer->count() > 1)
                  Answers
                  @else
                  Answer
                  @endif
                </li>
              </ul>

              <a href="{{ route('question.answers',['id'=>$question->id]) }}" class="btn btn-outline-primary btn-sm mt-4 py-1">See answers</a>
            </div>
          </div>
          @endforeach
          <div class="my-3">
              {{ $questions->links('pagination::bootstrap-5') }}
          </div>


          <!-- ask question form -->
          <h3 class="h4 mb-3" id="askQuestion">Ask a question</h3>
          <form action="{{ route('questions.store') }}" method="post">
              @csrf
            <div class="form-group mb-3">
              <select name="category_id" class="form-control @error('category_id') is-invalid
              @enderror">
                  <option disabled selected>Choose Category</option>
                  @foreach ($category as $data)
                  <option value="{{ $data->id }}">
                      {{ $data->name }}
                  </option>
                  @endforeach
              </select>
              @error('category_id')
              <span class="text-danger">
                  {{ $message }}
              </span>
              @enderror
            </div>

            <div class="form-group mb-3">
              <textarea class="summernote form-control @error('question')
              is-invalid
              @enderror" name="question" rows="10"
                placeholder="Enter question here..."></textarea>
                @error('question')
                <span class="text-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit Question</button>
          </form>

        </div>



        <aside class="col-lg-4 sidebar-home">
          <!-- Search -->
          <div class="widget">
            <h4 class="widget-title"><span>Search</span></h4>
            <form action="#!" class="widget-search">
              <input class="mb-3" id="search-query" name="s" type="search" placeholder="Type &amp; Hit Enter...">
              <i class="ti-search"></i>
              <button type="submit" class="btn btn-primary btn-block">Search</button>
            </form>
          </div>

          <!-- about me -->
          <div class="widget widget-about">
            <h4 class="widget-title">Hi, I am Alex!</h4>
            <img class="img-fluid" src="images/author.jpg" alt="Themefisher">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel in in donec iaculis tempus odio nunc laoreet
              . Libero ullamcorper.</p>
            <ul class="list-inline social-icons mb-3">

              <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>

            </ul>
            <a href="about-me.html" class="btn btn-primary mb-2">About me</a>
          </div>

          <!-- Promotion -->
          <div class="promotion">
            <img src="images/promotion.jpg" class="img-fluid w-100">
            <div class="promotion-content">
              <h5 class="text-white mb-3">Create Stunning Website!!</h5>
              <p class="text-white mb-4">Lorem ipsum dolor sit amet, consectetur sociis. Etiam nunc amet id dignissim.
                Feugiat id tempor vel sit ornare turpis posuere.</p>
              <a href="https://themefisher.com/" class="btn btn-primary">Get Started</a>
            </div>
          </div>

          <!-- authors -->
          <div class="widget widget-author">
            <h4 class="widget-title">Authors</h4>
            <div class="media align-items-center">
              <div class="mr-3">
                <img class="widget-author-image" src="images/john-doe.jpg">
              </div>
              <div class="media-body">
                <h5 class="mb-1"><a class="post-title" href="author-single.html">Charls Xaviar</a></h5>
                <span>Author &amp; developer of Bexer, Biztrox theme</span>
              </div>
            </div>
            <div class="media align-items-center">
              <div class="mr-3">
                <img class="widget-author-image" src="images/kate-stone.jpg">
              </div>
              <div class="media-body">
                <h5 class="mb-1"><a class="post-title" href="author-single.html">Kate Stone</a></h5>
                <span>Author &amp; developer of Bexer, Biztrox theme</span>
              </div>
            </div>
            <div class="media align-items-center">
              <div class="mr-3">
                <img class="widget-author-image" src="images/john-doe.jpg" alt="John Doe">
              </div>
              <div class="media-body">
                <h5 class="mb-1"><a class="post-title" href="author-single.html">John Doe</a></h5>
                <span>Author &amp; developer of Bexer, Biztrox theme</span>
              </div>
            </div>
          </div>
          <!-- Search -->

          <div class="widget">
            <h4 class="widget-title"><span>Never Miss A News</span></h4>
            <form action="#!" method="post" name="mc-embedded-subscribe-form" target="_blank" class="widget-search">
              <input class="mb-3" id="search-query" name="s" type="search" placeholder="Your Email Address">
              <i class="ti-email"></i>
              <button type="submit" class="btn btn-primary btn-block" name="subscribe">Subscribe now</button>
              <div style="position: absolute; left: -5000px;" aria-hidden="true">
                <input type="text" name="b_463ee871f45d2d93748e77cad_a0a2c6d074" tabindex="-1">
              </div>
            </form>
          </div>

          <!-- categories -->
          <div class="widget widget-categories">
            <h4 class="widget-title"><span>Categories</span></h4>
            <ul class="list-unstyled widget-list">
              <li><a href="tags.html" class="d-flex">Creativity <small class="ml-auto">(4)</small></a></li>
              <li><a href="tags.html" class="d-flex">Demo <small class="ml-auto">(1)</small></a></li>
              <li><a href="tags.html" class="d-flex">Elements <small class="ml-auto">(1)</small></a></li>
              <li><a href="tags.html" class="d-flex">Food <small class="ml-auto">(1)</small></a></li>
              <li><a href="tags.html" class="d-flex">Microwave <small class="ml-auto">(1)</small></a></li>
              <li><a href="tags.html" class="d-flex">Natural <small class="ml-auto">(3)</small></a></li>
              <li><a href="tags.html" class="d-flex">Newyork city <small class="ml-auto">(1)</small></a></li>
              <li><a href="tags.html" class="d-flex">Nice <small class="ml-auto">(1)</small></a></li>
              <li><a href="tags.html" class="d-flex">Tech <small class="ml-auto">(2)</small></a></li>
              <li><a href="tags.html" class="d-flex">Videography <small class="ml-auto">(1)</small></a></li>
              <li><a href="tags.html" class="d-flex">Vlog <small class="ml-auto">(1)</small></a></li>
              <li><a href="tags.html" class="d-flex">Wondarland <small class="ml-auto">(1)</small></a></li>
            </ul>
          </div><!-- tags -->
          <div class="widget">
            <h4 class="widget-title"><span>Tags</span></h4>
            <ul class="list-inline widget-list-inline widget-card">
              <li class="list-inline-item"><a href="tags.html">City</a></li>
              <li class="list-inline-item"><a href="tags.html">Color</a></li>
              <li class="list-inline-item"><a href="tags.html">Creative</a></li>
              <li class="list-inline-item"><a href="tags.html">Decorate</a></li>
              <li class="list-inline-item"><a href="tags.html">Demo</a></li>
              <li class="list-inline-item"><a href="tags.html">Elements</a></li>
              <li class="list-inline-item"><a href="tags.html">Fish</a></li>
              <li class="list-inline-item"><a href="tags.html">Food</a></li>
              <li class="list-inline-item"><a href="tags.html">Nice</a></li>
              <li class="list-inline-item"><a href="tags.html">Recipe</a></li>
              <li class="list-inline-item"><a href="tags.html">Season</a></li>
              <li class="list-inline-item"><a href="tags.html">Taste</a></li>
              <li class="list-inline-item"><a href="tags.html">Tasty</a></li>
              <li class="list-inline-item"><a href="tags.html">Vlog</a></li>
              <li class="list-inline-item"><a href="tags.html">Wow</a></li>
            </ul>
          </div><!-- recent post -->
          <div class="widget">
            <h4 class="widget-title">Recent Post</h4>

            <!-- post-item -->
            <article class="widget-card">
              <div class="d-flex">
                <img class="card-img-sm" src="images/post/post-10.jpg">
                <div class="ml-3">
                  <h5><a class="post-title" href="post/elements/">Elements That You Can Use In This Template.</a></h5>
                  <ul class="card-meta list-inline mb-0">
                    <li class="list-inline-item mb-0">
                      <i class="ti-calendar"></i>15 jan, 2020
                    </li>
                  </ul>
                </div>
              </div>
            </article>

            <article class="widget-card">
              <div class="d-flex">
                <img class="card-img-sm" src="images/post/post-3.jpg">
                <div class="ml-3">
                  <h5><a class="post-title" href="post-details.html">Advice From a Twenty Something</a></h5>
                  <ul class="card-meta list-inline mb-0">
                    <li class="list-inline-item mb-0">
                      <i class="ti-calendar"></i>14 jan, 2020
                    </li>
                  </ul>
                </div>
              </div>
            </article>

            <article class="widget-card">
              <div class="d-flex">
                <img class="card-img-sm" src="images/post/post-7.jpg">
                <div class="ml-3">
                  <h5><a class="post-title" href="post-details.html">Advice From a Twenty Something</a></h5>
                  <ul class="card-meta list-inline mb-0">
                    <li class="list-inline-item mb-0">
                      <i class="ti-calendar"></i>14 jan, 2020
                    </li>
                  </ul>
                </div>
              </div>
            </article>
          </div>

          <!-- Social -->
          <div class="widget">
            <h4 class="widget-title"><span>Social Links</span></h4>
            <ul class="list-inline widget-social">
              <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>
            </ul>
          </div>
        </aside>
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
      @if (Session::has('questionMsg'))
      toastr.options = {
          'progressBar': true,
          'closeButton': true
      }
      toastr.success("{{ Session::get('questionMsg') }}",'Question',{timeOut:12000});
      @endif
      @if (Session::has('deleteMsg'))
      toastr.options = {
          'progressBar': true,
          'closeButton': true
      }
      toastr.error("{{ Session::get('deleteMsg') }}",'Delete',{timeOut:1200});
      @endif
  </script>
  @endpush
  @endsection
  {{-- @include('layouts.includes.banner') --}}
<!-- end of banner -->
