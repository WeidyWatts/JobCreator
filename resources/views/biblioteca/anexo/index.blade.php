<style>
    .action {
        cursor: pointer;
    }
</style>
<x-app-layout>

    <div class="flex justify-content-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <h1 class="card-header">Anexos</h1>
                <div class="card-body flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-3">
                            <div id="instrumentos" class="mb-4" >
                                <div class="row">
                                    <div class="col-md-9">
                                        <x-text-input id="search" class="block my-2" style="width: 100%" type="text" name="search" placeholder=" Pesquise por um titulo ou palavra chave..." />
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#AdicionarAnexo">Adicionar Novo</button>
                                    </div>
                                </div>
                            </div>

                            @if(isset($anexos))
                                @foreach($anexos as $anexo)
                                    <div class="item mb-4">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <h1><b>{{$anexo->titulo}}</b></h1>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <a class="action" href="{{route('anexo.download',$anexo->arquivo_anexo)}}" target="_blank"> <h2>Fazer Download do Anexo</h2></a>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="action mr-2"> <i class="fa-regular fa-star"></i>salvar</a>

                                                <a class="action mr-2" data-bs-toggle="modal" data-bs-target="#editarAnexo{{$anexo->id}}"> <i class="fa fa-check"></i> editar </a>

                                                <a class="action" data-bs-toggle="modal" data-bs-target="#deletarAnexo{{$anexo->id}}"><i class="fa fa-trash"></i> excluir </a>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                                {{ $anexos->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<div class="modal fade" id="AdicionarAnexo" tabindex="-1" aria-labelledby="AdicionarAnexoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Anexo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
            </div>
            <div class="modal-body">
                <form action="{{route('anexo.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 col-md-10">
                        <label for="titulo"  class="form-label">Titulo do Anexo</label>
                        <x-text-input id="name" style="width: 100%" type="text" name="titulo" />
                    </div>
                    <div class="mb-3">
                        <label for="anexc" class="form-label">Anexo</label>
                        <input type="file" name="anexo" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@if(isset($anexos))
    @foreach($anexos as $anexo)
        <div class="modal fade" id="editarAnexo{{$anexo->id}}" tabindex="-1" aria-labelledby="editarAnexoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Anexo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('anexo.update',$anexo->id )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 col-md-10">
                                <label for="titulo"  class="form-label">Titulo do Anexo</label>
                                <x-text-input id="name" style="width: 100%" type="text" name="titulo" value="{{$anexo->titulo}}" />
                            </div>
                            <div class="mb-3">
                                <label for="anexc" class="form-label">Anexo</label>
                                <input type="file" name="anexo" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif


@if(isset($anexos))
    @foreach($anexos as $anexo)
        <div class="modal fade" id="deletarAnexo{{$anexo->id}}" tabindex="-1" aria-labelledby="deletarAnexoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir Anexo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i> </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('anexo.destroy',$anexo->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h1>Deseja realmente Excluir {{$anexo->titulo}} ?</h1>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Deletar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    @endforeach
@endif
