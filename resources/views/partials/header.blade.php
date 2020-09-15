 <!--nav bar from boostrap 4-->
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
            <a class="navbar-brand" href="{{route('products')}}">my shop</a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarNav"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                @if(auth()->user())
                <li class="nav-item">
              <a class="nav-link" data-section=".about-us" href="{{route('getCart')}}">
              <i class="fas fa-shopping-cart"></i> shopping cart
             <span class="badge badge-primary">
              {{Session::has(auth()->id().'cart') ? Session::get(auth()->id().'cart')->totalQty : 0}}
            </span>
              </a>
                </li>
                @endif
            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-user"></i> user account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if(auth()->check())
          <a class="dropdown-item" href="{{route('user.profile')}}">profile</a>
          <a class="dropdown-item" href="{{route('logout')}}">logout</a>
          @else
           <a class="dropdown-item" href="{{route('signup')}}">sign up</a>
          <a class="dropdown-item" href="{{route('signin')}}">signin</a>
          @endif
      </li>
              </ul>
            </div>
          </div>
          </nav>