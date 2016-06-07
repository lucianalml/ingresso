<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>

            <li>
                <a href="{{ url('admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>

            <li>
                <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Vendas<span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Ordens <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="{{ url('admin/pedidos') }}">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i> Pedidos</a></li>
                            <li><a href="{{ url('admin/ingressos') }}">
                                <i class="fa fa-ticket" aria-hidden="true"></i> Ingressos</a></li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('admin/pagamento') }}">
                    <i class="fa fa-money" aria-hidden="true"></i> Pagamento</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-music" aria-hidden="true"></i> Eventos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('admin/eventos') }}">Gerenciar Eventos</a></li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-users" aria-hidden="true"></i> Usuarios<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('admin/usuarios') }}">Gerenciar Usuarios</a></li>
                    <li><a href="{{ url('admin/produtores') }}">Gerenciar Produtores</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->