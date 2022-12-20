<style>
    .nav-link{
        color: black;
    }
    .nav-link:focus, .nav-link:hover{
        color: #FA7301;
    }
    hr
    {
        border:solid 1px black;
        width: 96%;
        color: #FFFF00;
        height: 1px;

    }

 .ativo {
     color: #FA7301;
 }

 a:hover {
     color: #FA7301;
 }
</style>

<div class="container-fluid">
    <div class="row flex-nowrap" >
        <div class="col-auto col-md-3 col-xl-2 bg-white border">
            <div class="d-flex flex-column align-items-center align-items-sm-start pl-3 pt-2 text-white min-vh-100 sidebar-offcanvas" id="sidebar" role="navigation" >

                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-gray-900 text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item" >
                        <a href="/dashboard" class="nav-link align-middle px-0 ml-2 @if(Route::current()->getName() == 'dashboard') ativo @endif" >
                            <ion-icon name="home"></ion-icon> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" aria-expanded="true" class="nav-link px-0 align-middle dropdown-toggle ml-2">
                            <ion-icon name="library"></ion-icon> <span class="ms-1 d-none d-sm-inline">Biblioteca</span> </a>
                        <ul class="@if(Route::current()->getName() == 'anexo.index' || Route::current()->getName() == 'artigo.index' || Route::current()->getName() == 'link.index' || Route::current()->getName() == 'video.index' || Route::current()->getName() == 'teste.index')
                        collapse.show
                        @else
                        collapse
                        @endif
                        nav flex-column ml-5" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="{{route('anexo.index')}}" class="nav-link px-0 @if(Route::current()->getName() == 'anexo.index') ativo @endif"> <span class="d-none d-sm-inline">Anexos</span></a>
                            </li>
                            <li>
                                <a href="{{route('artigo.index')}}" class="nav-link px-0 @if(Route::current()->getName() == 'artigo.index') ativo @endif"> <span class="d-none d-sm-inline">Artigos</span></a>
                            </li>
                            <li>
                                <a href="{{route('link.index')}}" class="nav-link px-0 @if(Route::current()->getName() == 'link.index') ativo @endif"> <span class="d-none d-sm-inline">Links</span></a>
                            </li>
                            <li>
                                <a href="{{route('teste.index')}}" class="nav-link px-0 @if(Route::current()->getName() == 'teste.index') ativo @endif"> <span class="d-none d-sm-inline">Testes</span></a>
                            </li>
                            <li>
                                <a href="{{route('video.index')}}" class="nav-link px-0 @if(Route::current()->getName() == 'video.index') ativo @endif"> <span class="d-none d-sm-inline">Videos</span></a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="{{route('journey.index')}}" class="nav-link px-0 align-middle ml-2 mb-3 @if(Route::current()->getName() == 'journey.index') ativo @endif">
                            <i class="fa fa-route"></i><span class="ms-1 d-none d-sm-inline">Minhas Journeys</span></a>
                    </li>
                </ul>

                    <hr>

                <ul class="nav nav-pills flex-column mb-0 align-items-center align-items-sm-start" id="menu1">
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fa fa-plus"></i> <span class="ms-1 d-none d-sm-inline">Nova Pagina</span> </a>
                    </li>
                    <li>
                        <a href="{{route('favoritos.index')}}" class="nav-link px-0 align-middle @if(Route::current()->getName() == 'favoritos.index') ativo @endif">
                            <i class="fa fa-star"></i> <span class="ms-1 d-none d-sm-inline">Meus Favoritos</span> </a>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle dropdown-toggle">
                            <i class="fa-solid fa-handshake-angle"></i> <span class="ms-1 d-none d-sm-inline">Materias de Apoio</span> </a>
                        <ul class="@if(Route::current()->getName() == 'curriculo.index' || Route::current()->getName() == 'networking.index' || Route::current()->getName() == 'entrevista.index')
                            collapse.show
                            @else
                            collapse
                            @endif
                            nav flex-column ml-5" id="submenu3" data-bs-parent="#menu1">
                            <li class="w-100">
                                <a href="{{route('curriculo.index')}}" class="nav-link px-0"> <span class="d-none d-sm-inline @if(Route::current()->getName() == 'curriculo.index') ativo @endif">Meu Currículo</span></a>
                            </li>
                            <li>
                                <a href="{{route('networking.index')}}" class="nav-link px-0"> <span class="d-none d-sm-inline @if(Route::current()->getName() == 'networking.index') ativo @endif">Meu Networking</span></a>
                            </li>
                            <li>
                                <a href="{{route('entrevista.index')}}" class="nav-link px-0"> <span class="d-none d-sm-inline @if(Route::current()->getName() == 'entrevista.index') ativo @endif">Minha Entrevista</span></a>
                            </li>
                        </ul>
                    </li>

                </ul>

                <hr>

                <ul class="nav nav-pills flex-column mb-0 align-items-center align-items-sm-start" id="menu">
                    @if(auth()->user()->user_type == 1)
                        <li>
                        <a href="{{route('administracao.index')}}" class="nav-link px-0 align-middle  @if(Route::current()->getName() == 'administracao.index') ativo @endif">
                            <i class="fa-solid fa-user-gear"></i> <span class="ms-1 d-none d-sm-inline ">Administração</span> </a>
                        </li>

                    <li>
                        <a href="{{route('journey-registrada.index')}}" class="nav-link px-0 align-middle  @if(Route::current()->getName() == 'journey-registrada.index') ativo @endif">
                            <i class="fa-sharp fa-solid fa-map-location"></i> <span class="ms-1 d-none d-sm-inline">Journeys Registradas</span> </a>
                    </li>
                    @endif
                    <li>
                        <a href="/conta" class="nav-link px-0 align-middle @if(Route::current()->getName() == 'conta.index') ativo @endif">
                            <i class="fa-regular fa-user"></i> <span class="ms-1 d-none d-sm-inline">Minha Conta</span> </a>
                    </li>
                        @if(auth()->user()->user_type == 1)
                    <li>
                        <a href="{{route('monitoramento.index')}}" class="nav-link px-0 align-middle @if(Route::current()->getName() == 'monitoramento.index') ativo @endif">
                            <i class="fa-sharp fa-solid fa-chart-line"></i><span class="ms-1 d-none d-sm-inline">Monitoramento</span> </a>
                    </li>

                    <li>
                        <a href="{{route('time.index')}}" class="nav-link px-0 align-middle @if(Route::current()->getName() == 'time.index') ativo @endif">
                            <i class="fa-solid fa-users"></i> <span class="ms-1 d-none d-sm-inline">Times</span> </a>
                    </li>
                    @endif
                    @if(auth()->user()->user_type == 1|| auth()->user()->user_type == 2)
                    <li>
                        <a href="{{route('usuario.index')}}" class="nav-link px-0 align-middle @if(Route::current()->getName() == 'usuario.index') ativo @endif ">
                            <i class="fa fa-user"></i> <span class="ms-1 d-none d-sm-inline">Usuarios</span> </a>
                    </li>
                    @endif
                </ul>

            </div>
        </div>
        <div class="col py-3">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
        @endif

        <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('[data-toggle=offcanvas]').click(function() {
            $('.row-offcanvas').toggleClass('active');
        });

    });
</script>
