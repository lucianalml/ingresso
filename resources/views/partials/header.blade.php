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

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">A empresa</a></li>
            <li><a href="#">Fale com o ingressito</a></li>
            <li><a href="#">Dúvidas frequentes</a></li>
            <li><a href="#">Redes Sociais</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search" aria-hidden="true"></i> Busca por <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Estado</a></li>
            <li><a href="#">Cidade</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Estilo</a></li>
          </ul>
        </li>
      </ul>

      <form class="navbar-form navbar-left" role="search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Procurar eventos...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Vai!</button>
          </span>
        </div>
      </form>

      <ul class="nav navbar-nav navbar-right">
        <!-- Carrinho -->
        <li><a href="{{ url('/checkout') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 
        @if (Session::get('totalcarrinho') > 0)
          <span class="badge">{{ Session::get('totalcarrinho') }}</span>
        @endif
        </a></li>

          <!-- Links para autenticação -->
          @if (Auth::guest())

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user" aria-hidden="true"></i> Visitante <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('/login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                <li><a href="{{ url('/register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar</a></li>
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