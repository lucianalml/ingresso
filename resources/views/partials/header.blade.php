<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Ingresso.Art</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ url('/admin') }}">Admin</a></li>
        <li><a href="{{ url('/produtor') }}">Produtor</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Busca por <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Estado</a></li>
            <li><a href="#">Cidade</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Estilo</a></li>
          </ul>
        </li>
      </ul>

      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Buscar evento">
        </div>
        <button type="submit" class="btn btn-default">Pesquisar</button>
      </form>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrinho</a></li>

          <!-- Links para autenticação -->
          @if (Auth::guest())

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user" aria-hidden="true"></i> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('/login') }}">Logar</a></li>
                <li><a href="{{ url('/register') }}">Registrar</a></li>
              </ul>
            </li>

          @else

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> Minha conta</a></li>
                <li><a href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Pedidos</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
              </ul>
            </li>
            
          @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>