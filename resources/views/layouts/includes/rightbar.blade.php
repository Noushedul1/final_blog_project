<section class="section-sm">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-8  mb-5 mb-lg-0">
            @foreach ($posts as $post)
            <article class="card mb-4">
                <div class="post-slider">
                    <img src="{{asset('images/post_thumbnails/'.$post->thumbnail)}}" class="card-img-top" alt="post-thumb" height="400" width="100">
                </div>
                <div class="card-body">
                    <h3 class="mb-3"><a class="post-title" href="post-elements.html">
                    {{ $post->title }}
                    </a></h3>
                    <h5 class="mb-3"><a class="post-title" href="post-elements.html">
                    {{ $post->subtitle }}
                    </a></h5>
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
                        <i class="ti-calendar"></i>{{ date('d m y', strtotime($post->created_at)) }}
                    </li>
                    <li class="list-inline-item">
                        <ul class="card-meta-tag list-inline">
                        <li class="list-inline-item"><a href="tags.html">{{ $post->category->name }}</a></li>
                        </ul>
                    </li>
                    </ul>
                    <a href="{{ route('single_post_view',['id'=>$post->id]) }}" class="btn btn-outline-primary">Read More</a>
                </div>
            </article>
            @endforeach
    {{ $posts->links() }}
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
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel in in donec iaculis tempus odio nunc laoreet . Libero ullamcorper.</p>
            <ul class="list-inline social-icons mb-3">

              <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>

              <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>

            </ul>
            <a href="about-me.html" class="btn btn-primary mb-2">About me</a>
          </div>
          <!-- authors -->
          <div class="widget widget-author">
            <h4 class="widget-title">Authors</h4>
            @foreach ($users as $user)
            <div class="media align-items-center">
              <div class="mr-3">
                  @if ($user->photo)
                  <img class="widget-author-image" src="{{ asset('images/usr_photos/'.$user->photo) }}">
                  @else
                  <img class="widget-author-image" src="{{ asset('images/usr_photos/user.png') }}">
                  @endif
              </div>
              <div class="media-body">
                <h5 class="mb-1"><a class="post-title" href="author-single.html">{{ $user->name }}</a></h5>
                {{-- <span>Author &amp; {{ $user->description }}</span> --}}
                 {{-- every user need a descripition  --}}
              </div>
            </div>
            @endforeach
          </div>
          <!-- Search -->

          <div class="widget">
            <h4 class="widget-title"><span>Never Miss A News</span></h4>
            <form action="#!" method="post" name="mc-embedded-subscribe-form" target="_blank"
              class="widget-search">
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
                @foreach ($category as $categories)
                <li><a href="{{ route('filter_by_category',['category_id'=>$categories->id]) }}" class="d-flex">{{ $categories->name }} <small class="ml-auto">({{ $categories->posts->count() }})</small></a></li>
                @endforeach
            </ul>
          </div><!-- tags -->
          <div class="widget">
            <h4 class="widget-title"><span>Tags</span></h4>
            <ul class="list-inline widget-list-inline widget-card">
                @foreach ($category as $categories)
                <li class="list-inline-item"><a href="{{ route('filter_by_category',['category_id'=>$categories->id]) }}">{{ $categories->name }}</a></li>
                @endforeach
            </ul>
          </div><!-- recent post -->
          <div class="widget">
            <h4 class="widget-title">Recent Post</h4>

            <!-- post-item -->
            @for ($i =0;$i <3;$i++)
            <article class="widget-card">
              <div class="d-flex">
                {{-- <img class="card-img-sm" src="{{ asset('images/post_thumbnails/'.$posts[$i])->thumbnail }}"> --}}
                <div class="ml-3">
                  <h5><a class="post-title" href="{{ route('single_post_view',['id'=>$posts[$i]->id]) }}">{{ $posts[$i]->title }}</a></h5>
                  <ul class="card-meta list-inline mb-0">
                    <li class="list-inline-item mb-0">
                      <i class="ti-calendar"></i>{{ $posts[$i]->created_at }}
                    </li>
                  </ul>
                </div>
              </div>
            </article>
            @endfor
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
