<nav class="navbar navbar-default" style="background-color: #FCF979">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      @if(Auth::check())
      <a class="navbar-brand" href="{{route('login')}}">Admin</a>
      @endif
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="{{url('/')}}">Accueil</a>
        </li>
        @if(!(Auth::check()) )
        @forelse($types as $id => $type)
        <li class="nav-item">
          <a class="nav-link" href="{{route('type', $type)}}">{{ucfirst($type)}}</a>
        </li>
        @empty @endforelse @endif
        <li class="nav-item">
          <a class="nav-link" href="{{route('contact')}}">Contact</a>
        </li>
      </ul>

      @if(Auth::check())
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="{{route('login')}}">
            <span class="glyphicon glyphicon-user"></span> Dashboard</a>
        </li>
        <li>
          <a href="{{route('logout')}}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <span class="glyphicon glyphicon-log-in"></span> Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li>
      </ul>
      @else @endif
    </div>
  </div>
</nav>