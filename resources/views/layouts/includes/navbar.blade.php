<header class="navigation fixed-top">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-white">
        <a class="navbar-brand order-1" href="index.html">
          <img class="img-fluid" width="100px" src="{{asset('usr_assets/images/logo.png')}}"
            alt="Reader | Hugo Personal Blog Template">
        </a>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                homepage <i class="ti-angle-down ml-1"></i>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="index-full.html">Homepage Full Width</a>

                <a class="dropdown-item" href="index-full-left.html">Homepage Full With Left Sidebar</a>

                <a class="dropdown-item" href="index-full-right.html">Homepage Full With Right Sidebar</a>

                <a class="dropdown-item" href="index-list.html">Homepage List Style</a>

                <a class="dropdown-item" href="index-list-left.html">Homepage List With Left Sidebar</a>

                <a class="dropdown-item" href="index-list-right.html">Homepage List With Right Sidebar</a>

                <a class="dropdown-item" href="index-grid.html">Homepage Grid Style</a>

                <a class="dropdown-item" href="index-grid-left.html">Homepage Grid With Left Sidebar</a>

                <a class="dropdown-item" href="index-grid-right.html">Homepage Grid With Right Sidebar</a>

              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                About <i class="ti-angle-down ml-1"></i>
              </a>
              <div class="dropdown-menu">

                <a class="dropdown-item" href="about-me.html">About Me</a>

                <a class="dropdown-item" href="about-us.html">About Us</a>

              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="">Contact</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('questions') }}">Question & Answer</a>
            </li>
          </ul>
        </div>

        <div class="order-2 order-lg-3 d-flex align-items-center">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      @auth
                        @if (auth()->user()->photo)
                        <img src="{{ asset('images/usr_photos/'.auth()->user()->photo )}}" alt="" height="40" width="40" class="rounded-circle">
                        @else
                        <img src="{{ asset('images/usr_photos/user.png')}}" alt="" height="40" width="40" class="rounded-circle">
                        @endif
                          @else
                          <img src="{{ asset('images/usr_photos/user.png')}}" alt="" height="40" width="40" class="rounded-circle">
                      @endauth

                    </a>
                    <div class="dropdown-menu">
                        @auth
                        <a class="dropdown-item" href="author.html">
                            {{ auth()->user()->name }}
                        </a>

                        {{-- <a class="dropdown-item" href="{{ route('logout') }}">Logout</a> --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                            @else
                            <a class="dropdown-item" href="{{ route('login') }}">Login</a>

                            <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                        @endauth

                    </div>
                  </li>
            </ul>

          <!-- search -->
          <form class="search-bar">
            <input id="search-query" name="s" type="search" placeholder="Type &amp; Hit Enter...">
          </form>

          <button class="navbar-toggler border-0 order-1" type="button" data-toggle="collapse" data-target="#navigation">
            <i class="ti-menu"></i>
          </button>
        </div>

      </nav>
    </div>
  </header>
