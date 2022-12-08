<x-app-layout>
    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><b>Usuarios</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn mt-2 salvar"  data-bs-toggle="modal" data-bs-target="#AdicionarUsuario">Adicionar Novo</button>
                                    </div>
                                </div>
                            </div>
                            @if(count($usuarios)>0)
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Ultimo Acesso</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($usuarios as $usuario)
                                        <tr>
                                            <td>{{$usuario->name}}</td>
                                            <td>{{$usuario->email}}</td>
                                            <td> {{$usuario->ultimo_acesso ? Carbon\Carbon::parse($usuario->ultimo_acesso)->format('d/m/Y') : '--'}}   </td>
                                            <td>{{$usuario->cargo}}</td>
                                            <td>@if($usuario->status == 1) Ativo @else Inativo @endif </td>
                                            <td>
                                                <i class="fa fa-pen" aria-hidden="true"></i>
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="AdicionarUsuario" tabindex="-1" aria-labelledby="AdicionarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('usuario.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 col-md-10">
                        <label for="name"  class="form-label">Nome da Usuario</label>
                        <x-text-input id="name" style="width: 100%" type="text" name="name" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="email"  class="form-label">Email</label>
                        <x-text-input id="email" style="width: 100%" type="text" name="email" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="cargo"  class="form-label">Cargo</label>
                        <x-text-input id="cargo" style="width: 100%" type="text" name="cargo" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn salvar">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@if(isset($usuarios))
    @foreach($usuarios as $usuario)
        <div class="modal fade" id="editarUsuario{{$usuario->id}}" tabindex="-1" aria-labelledby="editarUsuarioLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('usuario.update',$usuario->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo do Usuario</label>
                                <x-text-input id="name" style="width: 100%" type="text" name="titulo" value="{{$usuario->nome_usuario}}" />
                            </div>
                            <div class="mb-3">
                                <label for="anexc" class="form-label">Usuario</label>
                                <input type="file" name="usuario" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn salvar">Salvar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif


@if(isset($usuarios))
    @foreach($usuarios as $usuario)
        <div class="modal fade" id="deletarUsuario{{$usuario->id}}" tabindex="-1" aria-labelledby="deletarUsuarioLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('usuario.destroy',$usuario->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$usuario->nome_usuario}} ?</h1>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn cancelar" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn salvar">Deletar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    @endforeach
@endif
