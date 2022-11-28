<x-app-layout>
    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header header-creator"><b>Administracao</b></h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn mt-2 salvar"  data-bs-toggle="modal" data-bs-target="#AdicionarEmpresa">Adicionar Novo</button>
                                    </div>
                                </div>
                            </div>
                            @if(count($empresas)>0)
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">CNPJ</th>
                                        <th scope="col">Relatório</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($empresas as $empresa)
                                        <tr>
                                            <td>{{$empresa->nome_empresa}}</td>
                                            <td>{{$empresa->cnpj}}</td>
                                            <td><i class="fa fa-file" aria-hidden="true"></i></td>
                                            <td>{{$empresa->status}}</td>
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

<div class="modal fade" id="AdicionarEmpresa" tabindex="-1" aria-labelledby="AdicionarEmpresaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header header-creator">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('administracao.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 col-md-10">
                        <label for="name_empresa"  class="form-label">Nome da Empresa</label>
                        <x-text-input id="name_empresa" style="width: 100%" type="text" name="name_empresa" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="cnpj"  class="form-label">CNPJ</label>
                        <x-text-input id="cnpj" style="width: 100%" type="text" name="cnpj" />
                    </div>
                    <div class="mb-3 col-md-10">
                        <label for="email"  class="form-label">Email do Responsável</label>
                        <x-text-input id="email" style="width: 100%" type="text" name="email" />
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

@if(isset($empresas))
    @foreach($empresas as $empresa)
        <div class="modal fade" id="editarEmpresa{{$empresa->id}}" tabindex="-1" aria-labelledby="editarEmpresaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Empresa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('administracao.update',$empresa->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo do Empresa</label>
                                <x-text-input id="name" style="width: 100%" type="text" name="titulo" value="{{$empresa->nome_empresa}}" />
                            </div>
                            <div class="mb-3">
                                <label for="anexc" class="form-label">Empresa</label>
                                <input type="file" name="empresa" class="form-control">
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


@if(isset($empresas))
    @foreach($empresas as $empresa)
        <div class="modal fade" id="deletarEmpresa{{$empresa->id}}" tabindex="-1" aria-labelledby="deletarEmpresaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-creator">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir Empresa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('administracao.destroy',$empresa->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$empresa->nome_empresa}} ?</h1>
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
