<nav class="navbar navbar-default fixat">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route ('home')}}">Krod eCommerce</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
      <ul class="nav navbar-nav navbar-center">
          <div class="buscar">
              <li><input type="text" class="form-control" placeholder="buscar..." style="margin:10px auto; width:100%;"></li>
          </div>
          <button class="btn btn-info btn-sm" style="margin-left:10px; position:relative; left:45%;"><i class="material-icons" style="font-size:10px;">search</i></button>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{route('cart-show')}}"><i class="fa fa-shopping-cart"></i></a></li>
        <li><a href="#dades">Nosaltres</a></li>
        <li><a href="#dades">Contacte</a></li>
        @include('store.partials.menu-user')
      </ul>
    </div>
  </div>
</nav>
