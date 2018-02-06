<nav class="navbar navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"><a href="{{url('/')}}">Accueil</a></span>
                @forelse($types as $id => $type)
                <span class="icon-bar"><a href="{{route('type', $type)}}">{{ucfirst($type)}}</a></span>
                @empty
                <span class="icon-bar"><a href='#'>Pas de stage ni formation</a></span>
                @endforelse
                <span class="icon-bar"><a href="#">Contact</a></span>
            </button>
            
            <a class="navbar-brand" href="#"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
            <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="{{url('/')}}">Accueil</a>
            </li>
            @forelse($types as $id => $type)
            <li class="nav-item">
              <a class="nav-link" href="{{route('type', $type)}}">{{ucfirst($type)}}</a>
            </li>
            @empty
            <li class="nav-item">
              <a class="nav-link" href="#">Pas de stage ni formation</a>
            </li>
            @endforelse
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
               (backoffice)
            </ul>
        </div>
    </div>
</nav>